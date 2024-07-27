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
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-chart-bar"></i> Grafik Hasil Perangkingan</h6>
        </div>
        <div class="card-body">
            <canvas id="rankingBarChart"></canvas>
        </div>
    </div>

    <!-- Menambahkan grafik line -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-chart-line"></i> Grafik Hasil Perangkingan (Line)</h6>
        </div>
        <div class="card-body">
            <canvas id="rankingLineChart"></canvas>
        </div>
    </div>
</div>

<?php
// Mengambil data untuk grafik
$names = json_encode(array_column($scores, 'nama'));
$scores = json_encode(array_column($scores, 'total_score'));

// Script untuk grafik bar
$scriptBar = <<<JS
var ctxBar = document.getElementById('rankingBarChart').getContext('2d');
var rankingBarChart = new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: $names,
        datasets: [{
            label: 'Grafik Hasil Skor tiap Karyawan (bar)',
            data: $scores,
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
JS;
$this->registerJs($scriptBar, \yii\web\View::POS_END);

// Script untuk grafik line
$scriptLine = <<<JS
var ctxLine = document.getElementById('rankingLineChart').getContext('2d');
var rankingLineChart = new Chart(ctxLine, {
    type: 'line',
    data: {
        labels: $names,
        datasets: [{
            label: 'Grafik Hasil Skor tiap Karyawan (line)',
            data: $scores,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            fill: true
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
JS;
$this->registerJs($scriptLine, \yii\web\View::POS_END);
?>