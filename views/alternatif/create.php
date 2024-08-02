<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $model->isNewRecord ? 'Tambah Data Karyawan' : 'Edit Data Alternatif: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Data Karyawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="alternatif-<?= $model->isNewRecord ? 'create' : 'update' ?>">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alternatif-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'divisi')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Update', ['class' => 'btn btn-success']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-info']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>