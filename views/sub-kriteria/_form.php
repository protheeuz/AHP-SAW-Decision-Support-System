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
        var totalSubKriteria = parseFloat($('#total-sub-kriteria').val());
        var totalBobotKriteria = parseFloat($('#total-bobot-kriteria').val());

        if (totalSubKriteria + nilaiSubKriteria > totalBobotKriteria) {
            $('#warningModalGlobal').modal('show');
            return false; // prevent form submission
        }

        return true;
    });
    JS,
    \yii\web\View::POS_READY
);
?>

<div class="sub-kriteria-form">

    <?php $form = ActiveForm::begin(['id' => 'subkriteria-form']); ?>

    <?= $form->field($model, 'nama_sub_kriteria')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nilai')->textInput(['type' => 'number', 'min' => 1, 'max' => 20, 'id' => 'subkriteria-nilai']) ?>

    <?= Html::hiddenInput('total-sub-kriteria', $total_sub_kriteria, ['id' => 'total-sub-kriteria']) ?>
    <?= Html::hiddenInput('total-bobot-kriteria', $total_bobot_kriteria, ['id' => 'total-bobot-kriteria']) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>