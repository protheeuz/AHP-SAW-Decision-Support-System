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
$user->email = 'hq@matimatech.com';
$user->nama = 'Matimatech';
$user->id_user_level = 1; // Sesuaikan dengan id_user_level untuk admin
$user->password_hash = Yii::$app->security->generatePasswordHash('admin');
$user->auth_key = Yii::$app->security->generateRandomString();
$user->access_token = Yii::$app->security->generateRandomString();
$user->created_at = time();
$user->updated_at = time();

if ($user->save()) {
    echo "Admin user created successfully!";
} else {
    echo "Failed to create admin user.";
    print_r($user->errors);
}
