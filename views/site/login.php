<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->registerCssFile('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;700;800;900&display=swap'); ?>

<div class="site-login d-flex justify-content-center align-items-center" style="height: 100vh; font-family: 'Poppins', sans-serif; background: url('<?= Yii::getAlias('@web') ?>/assets/img/kemdikbud.jpeg') no-repeat center center fixed; background-size: cover;">
    <div class="login-box bg-white p-5 rounded" style="width: 400px;">
        <div class="header text-center">
            <img src="<?= Yii::getAlias('@web') ?>/assets/img/logo1.png" class="img-fluid mb-4" style="max-width: 150px;">
            <h1 class="h4 mb-3">Halo, Selamat Datang!</h1>
            <p class="mb-4">Silahkan masuk terlebih dahulu</p>
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
            <span class="copy">Copyright &copy 2024 Kementerian Pendidikan dan Kebudayaan Riset dan Teknologi</span>
        </div>
    </div>
</div>

<style>
    .site-login .header {
        margin-bottom: 20px;
    }
    .custom-control-input {
        margin-top: 10px;
    }
    .login-box {
        background: rgba(255, 255, 255, 0.8);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>