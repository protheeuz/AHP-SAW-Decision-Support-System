<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SubKriteria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-kriteria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'deskripsi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nilai')->input('number', ['min' => 1, 'max' => 20]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>