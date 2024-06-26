<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Data Perhitungan';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="perhitungan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Perhitungan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'id_alternatif',
            'nilai',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>