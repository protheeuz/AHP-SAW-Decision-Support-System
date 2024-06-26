<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Update Data Kriteria';
$this->params['breadcrumbs'][] = ['label' => 'Data Kriteria', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="kriteria-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Yii::$app->session->getFlash('success'); ?>

    <div class="kriteria-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'kode_kriteria')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'jenis')->dropDownList([
            '' => '--Pilih Jenis Kriteria--',
            'Benefit' => 'Benefit',
            'Cost' => 'Cost',
        ], ['required' => true]) ?>
        <?= $form->field($model, 'bobot')->dropDownList(array_combine(range(1, 20), range(1, 20)), ['prompt' => '--Pilih Bobot--']) ?>

        <div class="form-group">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-info']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>