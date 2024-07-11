<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Kriteria';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kriteria-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="alert alert-info">
        Silahkan input data kriteria terlebih dahulu, setelah data kriteria terinput semua, maka nilai bobot akan diberikan berdasarkan perhitungan metode <b>AHP</b> dengan cara mengklik tombol <b>Hitung Bobot Preferensi AHP</b>.
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'kode_kriteria',
            'keterangan',
            'jenis',
            'bobot',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fas fa-eye"></i>', ['view', 'id_kriteria' => $model->id_kriteria], [
                            'title' => Yii::t('app', 'View'),
                            'class' => 'btn btn-primary btn-sm',
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fas fa-pencil-alt"></i>', ['update', 'id_kriteria' => $model->id_kriteria], [
                            'title' => Yii::t('app', 'Update'),
                            'class' => 'btn btn-warning btn-sm',
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fas fa-trash"></i>', ['delete', 'id_kriteria' => $model->id_kriteria], [
                            'title' => Yii::t('app', 'Delete'),
                            'class' => 'btn btn-danger btn-sm',
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method' => 'post',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>