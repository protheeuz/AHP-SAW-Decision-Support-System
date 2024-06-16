<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Edit Data Kriteria: ' . $model->keterangan;
$this->params['breadcrumbs'][] = ['label' => 'Data Kriteria', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->keterangan, 'url' => ['view', 'id' => $model->id_kriteria]];
$this->params['breadcrumbs'][] = 'Edit';
?>

<div class="kriteria-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="kriteria-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'kode_kriteria')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'jenis')->dropDownList([
            'Benefit' => 'Benefit',
            'Cost' => 'Cost',
        ], ['required' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-info']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>