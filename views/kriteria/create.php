<?php
use yii\helpers\Html;

$this->title = 'Tambah Data Kriteria';
$this->params['breadcrumbs'][] = ['label' => 'Data Kriteria', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kriteria-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Yii::$app->session->getFlash('success'); ?>
    <?= Yii::$app->session->getFlash('error'); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>