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

    <!-- Menambahkan grafik per kriteria -->
    <?php if (!empty($kriteriaScores)) : ?>
        <?php foreach ($kriteriaScores as $kriteria => $scoresByYear) : ?>
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

// Array warna untuk tiap tahun
$colors = json_encode(['rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(255, 206, 86, 0.6)', 'rgba(75, 192, 192, 0.6)', 'rgba(153, 102, 255, 0.6)', 'rgba(255, 159, 64, 0.6)']);
$borderColors = json_encode(['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)']);

// Debugging
echo "<script>console.log('Names: $names');</script>";
echo "<script>console.log('Scores Data: $scoresData');</script>";
echo "<script>console.log('Kriteria Data: $kriteriaData');</script>";

// Script untuk grafik per kriteria
$scriptKriteria = <<<JS
var kriteriaData = $kriteriaData;
var colors = $colors;
var borderColors = $borderColors;

for (var kriteria in kriteriaData) {
    var ctx = document.getElementById('chart_' + kriteria.replace(/ /g, '_')).getContext('2d');
    var datasets = Object.keys(kriteriaData[kriteria]).map(function(year, index) {
        return {
            label: year,
            data: kriteriaData[kriteria][year].map(function(item) { return item.nilai; }),
            backgroundColor: colors[index % colors.length],
            borderColor: borderColors[index % borderColors.length],
            borderWidth: 1
        };
    });

    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: kriteriaData[kriteria][Object.keys(kriteriaData[kriteria])[0]].map(function(item) { return item.nama; }),
            datasets: datasets
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
                    var clickedDatasetIndex = activePoints[0].datasetIndex;
                    var clickedIndex = activePoints[0].index;
                    var nama = chart.data.labels[clickedIndex];
                    var nilai = chart.data.datasets[clickedDatasetIndex].data[clickedIndex];
                    alert('Karyawan: ' + nama + ', Skor: ' + nilai);
                }
            }
        }
    });
}
JS;
$this->registerJs($scriptKriteria, \yii\web\View::POS_END);
?>