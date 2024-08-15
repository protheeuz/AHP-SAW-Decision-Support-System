<?php

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= Url::to(['admin/index']) ?>">
                <div class="sidebar-brand-icon">
                    <img src="<?= Url::to('@web/assets/img/logo-sidebar.png') ?>" style="width: 70%; height: auto;" alt="Logo">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="<?= Url::to(['admin/index']) ?>">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <?php if (Yii::$app->user->identity->id_user_level == 1 || Yii::$app->user->identity->id_user_level == 2): // Admin atau Kepala Bagian ?>
                <div class="sidebar-heading">
                    Master Data
                </div>

                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['kriteria/index']) ?>">
                        <i class="fas fa-fw fa-cube"></i>
                        <span>Data Kriteria</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['sub-kriteria/index']) ?>">
                        <i class="fas fa-fw fa-cubes"></i>
                        <span>Data Sub Kriteria</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['alternatif/index']) ?>">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Data Karyawan</span>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['penilaian/index']) ?>">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Data Penilaian</span>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['perhitungan/index']) ?>">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Data Perhitungan</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (Yii::$app->user->identity->id_user_level == 1 || Yii::$app->user->identity->id_user_level == 3): // Admin atau Karyawan ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['penilaian/index']) ?>">
                        <i class="fas fa-fw fa-edit"></i>
                        <span>Data Penilaian</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['perhitungan/index']) ?>">
                        <i class="fas fa-fw fa-calculator"></i>
                        <span>Data Perhitungan</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['perhitungan/hasil']) ?>">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Hasil Perankingan</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (Yii::$app->user->identity->id_user_level == 1 || Yii::$app->user->identity->id_user_level == 2): // Admin atau Kepala Bagian ?>
                <hr class="sidebar-divider">

                <div class="sidebar-heading">
                    Master User
                </div>

                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['user/index']) ?>">
                        <i class="fas fa-fw fa-users-cog"></i>
                        <span>Data User</span>
                    </a>
                </li>
            <?php endif; ?>

            <li class="nav-item">
                <a class="nav-link" href="<?= Url::to(['profile/index']) ?>">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Data Profil</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= Html::encode(Yii::$app->user->identity->username) ?></span>
                                <img class="img-profile rounded-circle" src="<?= Url::to('@web/assets/img/user.png') ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= Url::to(['profile/index']) ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= Url::to(['site/logout']) ?>" data-method="post">
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
                    <?= $content ?>
                </div>
                <!-- End of Page Content -->
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Tigor Peryanto Hamonangan Nainggolan &copy; 204419005</span>
                    </div>
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Universitas Persada Indonesia YAI</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah anda yakin mau keluar?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= Url::to(['site/logout']) ?>" data-method="post">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <?php $this->endBody() ?>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= Url::to('@web/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= Url::to('@web/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= Url::to('@web/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= Url::to('@web/js/sb-admin-2.min.js') ?>"></script>

    <!-- Page level plugins -->
    <script src="<?= Url::to('@web/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= Url::to('@web/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?= Url::to('@web/js/demo/datatables-demo.js') ?>"></script>

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

</body>

</html>
<?php $this->endPage() ?>