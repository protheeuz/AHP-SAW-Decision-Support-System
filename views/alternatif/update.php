<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Edit Data Alternatif: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Data Karyawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id_alternatif]];
$this->params['breadcrumbs'][] = 'Edit';
?>

<div class="alternatif-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alternatif-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'divisi')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-info']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>