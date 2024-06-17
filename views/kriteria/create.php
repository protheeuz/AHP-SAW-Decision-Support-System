<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Tambah Data Kriteria';
$this->params['breadcrumbs'][] = ['label' => 'Data Kriteria', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="kriteria-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Yii::$app->session->getFlash('success'); ?>

    <div class="kriteria-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'kode_kriteria')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'bobot')->input('number', ['min' => 1, 'max' => 20]) ?>
        <?= $form->field($model, 'jenis')->dropDownList([
            '' => '--Pilih Jenis Kriteria--',
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