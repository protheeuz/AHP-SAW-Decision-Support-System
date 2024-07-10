<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Data Perhitungan';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="penilaian-data-perhitungan">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Data Perhitungan</h6>
        </div>

        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'id_alternatif',
                        'value' => 'alternatif.nama', // Menggunakan relasi untuk menampilkan nama alternatif
                    ],
                    [
                        'attribute' => 'id_kriteria',
                        'value' => 'kriteria.keterangan', // Menggunakan relasi untuk menampilkan keterangan kriteria
                    ],
                    'nilai',
                ],
                'pager' => [
                    'options' => ['class' => 'pagination'],
                    'prevPageLabel' => '&laquo;',
                    'nextPageLabel' => '&raquo;',
                    'maxButtonCount' => 5,
                ],
            ]); ?>
        </div>
    </div>
</div>