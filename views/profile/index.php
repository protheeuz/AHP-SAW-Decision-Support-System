<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Data Profile';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Yii::$app->session->getFlash('success'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-edit"></i> Edit Data Profile</h6>
        </div>

        <?php $form = ActiveForm::begin(['action' => ['profile/update', 'id' => $profile->id_user]]); ?>
            <div class="card-body">
                <div class="row">
                    <?= $form->field($profile, 'email', ['options' => ['class' => 'form-group col-md-6']])->textInput(['maxlength' => true]) ?>
                    <?= $form->field($profile, 'username', ['options' => ['class' => 'form-group col-md-6']])->textInput(['maxlength' => true]) ?>
                    <?= $form->field($profile, 'password', ['options' => ['class' => 'form-group col-md-6']])->passwordInput(['maxlength' => true]) ?>
                    <?= $form->field($profile, 'nama', ['options' => ['class' => 'form-group col-md-6']])->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="card-footer text-right">
                <?= Html::submitButton('<i class="fa fa-save"></i> Update', ['class' => 'btn btn-success']) ?>
                <?= Html::resetButton('<i class="fa fa-sync-alt"></i> Reset', ['class' => 'btn btn-info']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>