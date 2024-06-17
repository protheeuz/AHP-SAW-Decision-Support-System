<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SubKriteria */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs(
    <<<JS
    $('#subkriteria-form').on('beforeSubmit', function(e) {
        var form = $(this);
        var nilaiSubKriteria = parseFloat($('#subkriteria-nilai').val());
        var totalSubKriteria = parseFloat('$total_sub_kriteria');
        var totalBobotKriteria = parseFloat('$total_bobot_kriteria');

        if (totalSubKriteria + nilaiSubKriteria > totalBobotKriteria) {
            alert('Total nilai sub-kriteria tidak bisa melebihi nilai total bobot kriteria.');
            return false;
        }
        return true;
    });
    JS,
    \yii\web\View::POS_READY
);
?>

<div class="sub-kriteria-form">

    <?php $form = ActiveForm::begin(['id' => 'subkriteria-form']); ?>

    <?= $form->field($model, 'deskripsi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nilai')->textInput(['type' => 'number', 'min' => 1, 'max' => 20, 'id' => 'subkriteria-nilai']) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>