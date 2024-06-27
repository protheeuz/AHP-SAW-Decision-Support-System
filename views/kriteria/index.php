<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Data Kriteria';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="kriteria-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Yii::$app->session->getFlash('success'); ?>

    <p>
        <?= Html::a('Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Bobot Preferensi AHP', ['prioritas'], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="alert alert-info">
        Silahkan input data kriteria terlebih dahulu, setelah data kriteria terinput semua, maka nilai bobot akan diberikan berdasarkan perhitungan metode <b>AHP</b> dengan cara mengklik tombol <b>Bobot Preferensi AHP</b>.
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'kode_kriteria',
            'keterangan',
            'jenis',
            'bobot', 
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>