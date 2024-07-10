<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="sub-kriteria-form">

    <?php $form = ActiveForm::begin(['id' => 'subkriteria-form', 'enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'deskripsi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nilai')->textInput(['type' => 'number', 'min' => 1, 'id' => 'subkriteria-nilai']) ?>

    <?= Html::hiddenInput('total-sub-kriteria', $total_sub_kriteria, ['id' => 'total-sub-kriteria']) ?>
    <?= Html::hiddenInput('total-bobot-kriteria', $total_bobot_kriteria, ['id' => 'total-bobot-kriteria']) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>