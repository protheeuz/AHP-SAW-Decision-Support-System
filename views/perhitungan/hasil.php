<?php
use yii\helpers\Html;

$this->title = 'Hasil Akhir Perangkingan';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="perhitungan-hasil">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fa fa-print"></i> Cetak Data', ['cetak-laporan-hasil'], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Hasil Akhir Perankingan</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr align="center">
                            <th>Alternatif</th>
                            <th>Nilai</th>
                            <th width="15%">Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($hasil as $keys): ?>
                        <tr align="center">
                            <td align="left">
                                <?= Html::encode($keys->alternatif->nama) ?>
                            </td>
                            <td><?= round($keys->nilai, 3) ?></td>
                            <td><?= $no ?></td>
                        </tr>
                        <?php $no++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>