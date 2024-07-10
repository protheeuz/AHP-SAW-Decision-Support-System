<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Kriteria */

$this->title = 'Update Data Kriteria: ' . $model->keterangan;
$this->params['breadcrumbs'][] = ['label' => 'Data Kriteria', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->keterangan, 'url' => ['view', 'id_kriteria' => $model->id_kriteria]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kriteria-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="kriteria-form">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'kode_kriteria')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'jenis')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'bobot')->textInput() ?>
        <div class="form-group">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>