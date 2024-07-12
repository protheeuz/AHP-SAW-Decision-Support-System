<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Data User';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Yii::$app->session->getFlash('success'); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Daftar Data User</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'nama',
                        'email:email',
                        'username',
                        [
                            'attribute' => 'userLevel.user_level',
                            'label' => 'Level',
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => ' {view} {update} {delete}', // {view}
                            'buttons' => [
                                'view' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-eye"></i>', $url, [
                                        'title' => Yii::t('app', 'view'),
                                        'class' => 'btn btn-primary btn-sm',
                                    ]);
                                },
                                'update' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-edit"></i>', $url, [
                                        'title' => Yii::t('app', 'update'),
                                        'class' => 'btn btn-warning btn-sm',
                                    ]);
                                },
                                'delete' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-trash"></i>', $url, [
                                        'title' => Yii::t('app', 'delete'),
                                        'class' => 'btn btn-danger btn-sm',
                                        'data' => [
                                            'confirm' => 'Apakah anda yakin untuk menghapus data ini?',
                                            'method' => 'post',
                                        ],
                                    ]);
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>