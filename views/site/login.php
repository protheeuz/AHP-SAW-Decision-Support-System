<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login d-flex">
    <div class="login-left w-50 h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-6">
                <div class="header mt-100">
                    <img src="<?= Yii::getAlias('@web') ?>/assets/img/PWI3.png">
                    <h1>Helo, Selamat Datang!</h1>
                    <p> Silahkan masuk terlebih dahulu</p>
                </div>

                <?php if (Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?= Yii::$app->session->getFlash('error'); ?>
                </div>
                <?php endif; ?>

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-3 control-label'],
                    ],
                ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => "<div class=\"col-lg-offset-1 col-lg-8\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                ]) ?>

                <div class="form-group">
                    <div class="col-lg-offset-1 col-lg-8">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

                <span class="copy">Copyright &copy 2022 PT Parkland World Indonesia </span>
            </div>
        </div>
    </div>
    <div class="login-right w-50 h-100">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?= Yii::getAlias('@web') ?>/assets/img/Data1.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>
    </div>
</div>