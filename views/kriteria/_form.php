<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="kriteria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_kriteria')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'jenis')->dropDownList([
        '' => '--Pilih Jenis Kriteria--',
        'Benefit' => 'Benefit',
        'Cost' => 'Cost',
    ], ['required' => true]) ?>
    <?= $form->field($model, 'bobot')->textInput(['type' => 'number', 'min' => 1, 'max' => 100, 'required' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>