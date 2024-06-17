<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="sub-kriteria-create">

    <div class="sub-kriteria-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'id_kriteria')->hiddenInput()->label(false) ?>

        <?= $form->field($model, 'deskripsi')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'nilai')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>