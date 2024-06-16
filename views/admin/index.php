<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if (Yii::$app->user->identity->id_user_level == 1): ?>

<div class="site-index">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-home"></i> Dashboard</h1>
    </div>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        Selamat datang <span class="text-uppercase"><b><?= Html::encode(Yii::$app->user->identity->username); ?>!</b></span> Anda bisa mengoperasikan sistem dengan wewenang tertentu melalui pilihan menu di bawah.
    </div>
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <h4 class="h4 mb-0 font-weight-bold text-gray-800 text-secondary text-decoration-none"><?= $num ?></h4>
                            <p><div class="h5 mb-0 font-weight-normal text-gray-400 card-waves"><a href="<?= Url::to(['kriteria/index']); ?>" class="text-secondary text-decoration-none">Data Kriteria</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cube fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <h4 class="h4 mb-0 font-weight-bold text-gray-800 text-secondary text-decoration-none"><?= $sub ?></h4>
                            <p><div class="h5 mb-0 font-weight-normal text-gray-400"><a href="<?= Url::to(['sub-kriteria/index']); ?>" class="text-secondary text-decoration-none">Data Sub Kriteria</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cubes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <h4 class="text-primary h4 mb-0 font-weight-bold text-gray-800 text-decoration-none"><?= $alternatif ?></h4>
                            <p><div class="h5 mb-0 font-weight-normal text-gray-400"><a href="<?= Url::to(['alternatif/index']); ?>" class="text-secondary text-decoration-none">Data Alternatif</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <h4 class="h4 mb-0 font-weight-bold text-gray-800 text-secondary text-decoration-none"><?= $user ?></h4>
                            <p><div class="h5 mb-0 font-weight-normal text-gray-400"><a href="<?= Url::to(['user/index']); ?>" class="text-secondary text-decoration-none">User</a></div></p>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>      
    </div>
</div>

<?php elseif (Yii::$app->user->identity->id_user_level == 2): ?>

<div class="site-index">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-home"></i> Dashboard</h1>
    </div>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        Selamat datang <span class="text-uppercase"><b><?= Html::encode(Yii::$app->user->identity->username); ?>!</b></span> Anda bisa mengoperasikan sistem dengan wewenang tertentu.
    </div>
    <div class="row">
    </div>
</div>

<?php endif; ?>