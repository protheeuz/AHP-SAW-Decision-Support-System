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

    <!-- Menampilkan grafik per kriteria -->
    <?php if (!empty($kriteriaScores)) : ?>
        <?php foreach ($kriteriaScores as $kriteria => $scoresByYear) : ?>
            <div class="card shadow mb-4 mt-4">
                <div class="card-header py-3" id="header_<?= Html::encode(str_replace(' ', '_', $kriteria)) ?>">
                    <h6 class="m-0 font-weight-bold text-primary cursor-pointer"><i class="fa fa-chart-bar"></i> Grafik <?= Html::encode($kriteria) ?></h6>
                </div>
                <div class="card-body" id="container_<?= Html::encode(str_replace(' ', '_', $kriteria)) ?>">
                    <canvas id="chart_<?= Html::encode(str_replace(' ', '_', $kriteria)) ?>"></canvas>
                </div>
                <!-- Grafik divisi akan muncul di sini -->
                <div class="card-body divisi-chart-container" id="divisi_container_<?= Html::encode(str_replace(' ', '_', $kriteria)) ?>" style="display: none;">
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

$colors = json_encode(['rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(255, 206, 86, 0.6)', 'rgba(75, 192, 192, 0.6)', 'rgba(153, 102, 255, 0.6)', 'rgba(255, 159, 64, 0.6)']);
$borderColors = json_encode(['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)']);

$scriptKriteria = <<<JS
var kriteriaData = $kriteriaData;
var divisiData = $divisiData;
var colors = $colors;
var borderColors = $borderColors;

// Fungsi untuk membuat grafik per kriteria
function createKriteriaChart(kriteria) {
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

    new Chart(ctx, {
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

// Fungsi untuk membuat grafik per divisi
function createDivisiChart(kriteria) {
    var ctx = document.getElementById('divisi_chart_' + kriteria.replace(/ /g, '_')).getContext('2d');
    var labels = Object.keys(divisiData[kriteria]);
    var data = Object.values(divisiData[kriteria]);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Rata-rata Nilai',
                data: data,
                backgroundColor: colors,
                borderColor: borderColors,
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
}

// Membuat semua grafik per kriteria saat halaman dimuat
for (var kriteria in kriteriaData) {
    createKriteriaChart(kriteria);

    // Menambahkan event listener untuk header kriteria
    document.getElementById('header_' + kriteria.replace(/ /g, '_')).addEventListener('click', function() {
        var kriteriaName = this.id.replace('header_', '').replace(/_/g, ' ');
        var divisiContainer = document.getElementById('divisi_container_' + kriteriaName.replace(/ /g, '_'));

        // Tampilkan atau sembunyikan grafik divisi ketika kriteria diklik
        if (divisiContainer.style.display === 'none') {
            divisiContainer.style.display = 'block';
            createDivisiChart(kriteriaName);
        } else {
            divisiContainer.style.display = 'none';
        }
    });
}
JS;
$this->registerJs($scriptKriteria, \yii\web\View::POS_END);
?>