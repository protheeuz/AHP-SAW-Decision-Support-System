<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Tambah Data Alternatif';
$this->params['breadcrumbs'][] = ['label' => 'Data Alternatif', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="alternatif-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Yii::$app->session->getFlash('success'); ?>

    <div class="alternatif-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-info']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>