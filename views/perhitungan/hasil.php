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

    <!-- Grafik per kriteria -->
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

    <!-- Grafik per divisi -->
    <?php if (!empty($divisiScores)) : ?>
        <?php foreach ($divisiScores as $kriteria => $scoresByDivisi) : ?>
            <div class="card shadow mb-4 mt-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-chart-bar"></i> Grafik Nilai per-Team - <?= Html::encode($kriteria) ?></h6>
                </div>
                <div class="card-body">
                    <canvas id="divisi_chart_<?= Html::encode(str_replace(' ', '_', $kriteria)) ?>"></canvas>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</div>

<?php
// Mengambil data untuk grafik
$kriteriaData = json_encode($kriteriaScores);
$divisiData = json_encode($divisiScores);

// Warna untuk grafik per kriteria
$colorsKriteria = json_encode([
    'rgba(75, 192, 192, 0.8)', 
    'rgba(153, 102, 255, 0.8)', 
    'rgba(255, 159, 64, 0.8)', 
    'rgba(255, 206, 86, 0.8)', 
    'rgba(54, 162, 235, 0.8)', 
    'rgba(255, 99, 132, 0.8)'
]);

$borderColorsKriteria = json_encode([
    'rgba(75, 192, 192, 1)', 
    'rgba(153, 102, 255, 1)', 
    'rgba(255, 159, 64, 1)', 
    'rgba(255, 206, 86, 1)', 
    'rgba(54, 162, 235, 1)', 
    'rgba(255, 99, 132, 1)'
]);

// Warna untuk grafik per divisi dengan transparansi lebih tinggi
$colorsDivisi = json_encode([
    'rgba(54, 162, 235, 0.2)', // Warna lebih transparan
    'rgba(255, 99, 132, 0.2)', 
    'rgba(255, 206, 86, 0.2)', 
    'rgba(75, 192, 192, 0.2)', 
    'rgba(153, 102, 255, 0.2)', 
    'rgba(255, 159, 64, 0.2)'
]);

$borderColorsDivisi = json_encode([
    'rgba(54, 162, 235, 1)', // Tetap menggunakan garis tebal
    'rgba(255, 99, 132, 1)', 
    'rgba(255, 206, 86, 1)', 
    'rgba(75, 192, 192, 1)', 
    'rgba(153, 102, 255, 1)', 
    'rgba(255, 159, 64, 1)'
]);

$scriptKriteria = <<<JS
var kriteriaData = $kriteriaData;
var divisiData = $divisiData;
var colorsKriteria = $colorsKriteria;
var borderColorsKriteria = $borderColorsKriteria;
var colorsDivisi = $colorsDivisi;
var borderColorsDivisi = $borderColorsDivisi;

// Grafik per kriteria
for (var kriteria in kriteriaData) {
    var ctx = document.getElementById('chart_' + kriteria.replace(/ /g, '_')).getContext('2d');
    var datasets = Object.keys(kriteriaData[kriteria]).map(function(year, index) {
        return {
            label: year,
            data: kriteriaData[kriteria][year].map(function(item) { return item.nilai; }),
            backgroundColor: colorsKriteria[index % colorsKriteria.length],
            borderColor: borderColorsKriteria[index % borderColorsKriteria.length],
            borderWidth: 3
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
            }
        }
    });
}

// Grafik per divisi dengan area chart
for (var kriteria in divisiData) {
    var ctx = document.getElementById('divisi_chart_' + kriteria.replace(/ /g, '_')).getContext('2d');
    
    var labels = Object.keys(divisiData[kriteria]);
    var datasets = Object.keys(divisiData[kriteria]).map(function(divisi, index) {
        return {
            label: divisi,
            data: labels.map(function(label) { return divisiData[kriteria][divisi]; }),
            backgroundColor: colorsDivisi[index % colorsDivisi.length],  // Warna background lebih transparan
            borderColor: borderColorsDivisi[index % borderColorsDivisi.length], // Warna border tetap tebal
            borderWidth: 3,
            fill: true // Mengisi area di bawah garis untuk area chart
        };
    });

    var chart = new Chart(ctx, {
        type: 'line', 
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Divisi'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Nilai Rata-rata'
                    }
                }
            },
            plugins: {
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            }
        }
    });
}
JS;
$this->registerJs($scriptKriteria, \yii\web\View::POS_END);
?>