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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>