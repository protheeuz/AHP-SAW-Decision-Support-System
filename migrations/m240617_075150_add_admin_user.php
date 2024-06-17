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
            'username' => 'admin',
            'password' => Yii::$app->security->generatePasswordHash('admin'),
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