<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->registerCssFile('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;700;800;900&display=swap'); ?>

<div class="site-login d-flex" style="font-family: 'Poppins', sans-serif;">
    <div class="login-left w-50 h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-6">
                <div class="header mt-100 text-center">
                    <img src="<?= Yii::getAlias('@web') ?>/assets/img/logo1.png" class="img-fluid mb-4">
                    <h1>Halo, Selamat Datang!</h1>
                    <p>Silahkan masuk terlebih dahulu</p>
                </div>

                <div class="mt-4"></div> <!-- Spasi antara header dan form -->

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
                        'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-12 control-label'],
                    ],
                ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Username']) ?>
                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']) ?>
                <div class="form-group">
                    <div class="col-lg-12 custom-control custom-checkbox">
                        <?= $form->field($model, 'rememberMe')->checkbox([
                            'template' => "{input} {label}\n<div class=\"col-lg-12\">{error}</div>",
                            'class' => 'custom-control-input',
                            'labelOptions' => ['class' => 'custom-control-label']
                        ]) ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-12">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-user btn-block', 'name' => 'login-button']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

                <div class="text-center mt-3">
                    <span class="copy">Copyright &copy 2024 Kementerian Pendidikan dan Kebudayaan Riset dan Teknologi </span>
                </div>
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

<style>
    .mt-100 {
        margin-top: 100px;
    }
    .site-login .header {
        margin-bottom: 40px;
    }
    .custom-control-input {
        margin-top: 10px;
    }
</style>