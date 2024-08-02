<?php

use yii\helpers\Html;

$this->title = 'Hasil Perangkingan';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="penilaian-calculate">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Hasil Perangkingan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr align="center">
                            <th>Ranking</th>
                            <th>Nama Karyawan</th>
                            <th>Total Skor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $rank = 1;
                        foreach ($scores as $score) : ?>
                            <tr align="center">
                                <td><?= $rank ?></td>
                                <td align="left"><?= $score['nama'] ?></td>
                                <td><?= $score['total_score'] ?></td>
                            </tr>
                        <?php $rank++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Menambahkan grafik bar -->
    <!-- <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-chart-bar"></i> Grafik Hasil Perangkingan</h6>
        </div>
        <div class="card-body">
            <canvas id="rankingBarChart"></canvas>
        </div>
    </div> -->

    <!-- Menambahkan grafik line -->
    <!-- <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-chart-line"></i> Grafik Hasil Perangkingan (Line)</h6>
        </div>
        <div class="card-body">
            <canvas id="rankingLineChart"></canvas>
        </div>
    </div> -->

    <!-- Menambahkan grafik per kriteria -->
    <?php if (!empty($kriteriaScores)) : ?>
        <?php foreach ($kriteriaScores as $kriteria => $scores) : ?>
        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-chart-bar"></i> Grafik <?= Html::encode($kriteria) ?></h6>
            </div>
            <div class="card-body">
                <canvas id="chart_<?= Html::encode(str_replace(' ', '_', $kriteria)) ?>"></canvas>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>

</div>

<?php
// Mengambil data untuk grafik
$names = json_encode(array_column($scores, 'nama'));
$scoresData = json_encode(array_column($scores, 'total_score'));
$kriteriaData = json_encode($kriteriaScores);

// Script untuk grafik per kriteria
$scriptKriteria = <<<JS
var kriteriaData = $kriteriaData;
for (var kriteria in kriteriaData) {
    var ctx = document.getElementById('chart_' + kriteria.replace(/ /g, '_')).getContext('2d');
    var labels = kriteriaData[kriteria].map(function(item) { return item.nama; });
    var data = kriteriaData[kriteria].map(function(item) { return item.nilai; });
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Skor ' + kriteria,
                data: data,
                backgroundColor: 'rgba(153, 102, 255, 0.6)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            onClick: function(evt, item) {
                var activePoints = chart.getElementsAtEventForMode(evt, 'nearest', { intersect: true }, false);
                if (activePoints.length > 0) {
                    var clickedIndex = activePoints[0].index;
                    var nama = labels[clickedIndex];
                    var nilai = data[clickedIndex];
                    alert('Karyawan: ' + nama + ', Skor: ' + nilai);
                }
            }
        }
    });
}
JS;
$this->registerJs($scriptKriteria, \yii\web\View::POS_END);
?>