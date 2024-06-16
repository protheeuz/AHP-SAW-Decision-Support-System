<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot/assets';
    public $baseUrl = '@web/assets';
    public $css = [
        'vendor/fontawesome-free/css/all.min.css',
        'css/sb-admin-2.min.css',
        'vendor/datatables/dataTables.bootstrap4.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap',
    ];
    public $js = [
        'vendor/jquery/jquery.min.js',
        'vendor/bootstrap/js/bootstrap.bundle.min.js',
        'vendor/jquery-easing/jquery.easing.min.js',
        'js/sb-admin-2.min.js',
        'vendor/datatables/jquery.dataTables.min.js',
        'vendor/datatables/dataTables.bootstrap4.min.js',
        'js/demo/datatables-demo.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}