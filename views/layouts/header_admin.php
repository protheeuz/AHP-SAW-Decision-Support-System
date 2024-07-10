<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sistem Pendukung Keputusan Metode AHP SAW</title>

    <!-- Custom fonts for this template-->
    <link href="<?= Url::to('@web/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= Url::to('@web/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?= Url::to('@web/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
    <link rel="shortcut icon" href="<?= Url::to('@web/img/PWI2.png') ?>" type="image/x-icon">
    <link rel="icon" href="<?= Url::to('@web/img/PWI2.png') ?>" type="image/x-icon">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= Url::to(['admin/index']) ?>">
                <div>
                    <img src="<?= Url::to('@web/assets/img/PWI.png') ?>" width="150" height="50">
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= Url::to(['admin/index']) ?>">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Master Data
            </div>

            <!-- Nav Item - Data Kriteria -->
            <li class="nav-item">
                <a class="nav-link" href="<?= Url::to(['kriteria/index']) ?>">
                    <i class="fas fa-fw fa-cube"></i>
                    <span>Data Kriteria</span></a>
            </li>

            <!-- Nav Item - Data Sub Kriteria -->
            <li class="nav-item">
                <a class="nav-link" href="<?= Url::to(['sub-kriteria/index']) ?>">
                    <i class="fas fa-fw fa-cubes"></i>
                    <span>Data Sub Kriteria</span></a>
            </li>

            <!-- Nav Item - Data Alternatif -->
            <li class="nav-item">
                <a class="nav-link" href="<?= Url::to(['alternatif/index']) ?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Karyawan</span></a>
            </li>

            <!-- Nav Item - Data Penilaian -->
            <li class="nav-item">
                <a class="nav-link" href="<?= Url::to(['penilaian/index']) ?>">
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Data Penilaian</span></a>
            </li>

            <!-- Nav Item - Data Perhitungan -->
            <li class="nav-item">
                <a class="nav-link" href="<?= Url::to(['perhitungan/index']) ?>">
                    <i class="fas fa-fw fa-calculator"></i>
                    <span>Data Perhitungan</span></a>
            </li>

            <!-- Nav Item - Hasil Perankingan -->
            <li class="nav-item">
                <a class="nav-link" href="<?= Url::to(['perhitungan/hasil']) ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Hasil Perankingan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Master User
            </div>

            <!-- Nav Item - Data User -->
            <li class="nav-item">
                <a class="nav-link" href="<?= Url::to(['user/index']) ?>">
                    <i class="fas fa-fw fa-users-cog"></i>
                    <span>Data User</span></a>
            </li>

            <!-- Nav Item - Data Profil -->
            <li class="nav-item">
                <a class="nav-link" href="<?= Url::to(['profile/index']) ?>">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Data Profil</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn text-primary d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="text-uppercase mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?= Html::encode(Yii::$app->user->identity->username) ?>
                                </span>
                                <img src="<?= Url::to('@web/assets/img/user.png') ?>" class="img-profile rounded-circle">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= Url::to(['profile/index']) ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <div class="container-fluid">