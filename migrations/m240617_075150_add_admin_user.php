<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m240617_075150_add_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%user}}', [
            'id_user_level' => 1, // Sesuaikan dengan id_user_level untuk admin
            'email' => 'hq@matimatech.com',
            'nama' => 'Matimatech',
            'username' => 'tigor',
            'password_hash' => Yii::$app->security->generatePasswordHash('tigor123'), // Menggunakan password_hash
            'auth_key' => Yii::$app->security->generateRandomString(), // Menghasilkan auth_key acak
            'access_token' => Yii::$app->security->generateRandomString(), // Menghasilkan access_token acak
            'created_at' => time(), // Timestamp untuk waktu pembuatan
            'updated_at' => time(), // Timestamp untuk waktu update
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%user}}', ['username' => 'admin']);
    }
}
