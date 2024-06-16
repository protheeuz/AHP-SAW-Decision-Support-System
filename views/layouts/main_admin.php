<?php

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= Yii::$app->homeUrl ?>">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Admin</div>
        </a>

        <hr class="sidebar-divider my-0">

        <li class="nav-item">
            <a class="nav-link" href="<?= Yii::$app->homeUrl ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Interface
        </div>

        <li class="nav-item">
            <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['kriteria/index']) ?>">
                <i class="fas fa-fw fa-cube"></i>
                <span>Data Kriteria</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['sub-kriteria/index']) ?>">
                <i class="fas fa-fw fa-cubes"></i>
                <span>Data Sub Kriteria</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['alternatif/index']) ?>">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Alternatif</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['user/index']) ?>">
                <i class="fas fa-fw fa-user"></i>
                <span>User</span>
            </a>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
    </ul>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= Html::encode(Yii::$app->user->identity->username) ?></span>
                            <img class="img-profile rounded-circle" src="<?= Yii::getAlias('@web') ?>/assets/img/user.png">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= Yii::$app->urlManager->createUrl(['site/logout']) ?>" data-method="post">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= $content ?>
            </div>
            <!-- End of Page Content -->
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>