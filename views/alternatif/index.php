<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Data Karyawan';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="alternatif-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Yii::$app->session->getFlash('success'); ?>

    <p>
        <?= Html::a('Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nama',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fas fa-eye"></i>', ['view', 'id' => $model->id_alternatif], [
                            'title' => Yii::t('app', 'View'),
                            'class' => 'btn btn-primary btn-sm',
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fas fa-pencil-alt"></i>', ['update', 'id' => $model->id_alternatif], [
                            'title' => Yii::t('app', 'Update'),
                            'class' => 'btn btn-warning btn-sm',
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fas fa-trash"></i>', ['delete', 'id' => $model->id_alternatif], [
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