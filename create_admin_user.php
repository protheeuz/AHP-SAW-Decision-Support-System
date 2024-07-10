<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';
$config = require __DIR__ . '/config/console.php'; // Menggunakan konfigurasi console

$application = new yii\console\Application($config);

// Pastikan aplikasi tidak menjalankan respon HTTP
$application->state = \yii\base\Application::STATE_BEFORE_REQUEST;

use app\models\User;

// Buat pengguna admin baru
$user = new User();
$user->username = 'admin';
$user->email = 'hq@kemdikbud.go.id';
$user->nama = 'HR Manager';
$user->id_user_level = 1; // Sesuaikan dengan id_user_level untuk admin
$user->password_hash = Yii::$app->security->generatePasswordHash('kemdikbud');
$user->created_at = date('Y-m-d H:i:s');
$user->updated_at = date('Y-m-d H:i:s');

if ($user->save()) {
    echo "Admin user created successfully!";
} else {
    echo "Failed to create admin user.";
    print_r($user->errors);
}