<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Profile extends ActiveRecord
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['email', 'username', 'password', 'nama'], 'required'],
            [['email', 'username', 'password', 'nama'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_user' => 'ID',
            'email' => 'E-Mail',
            'username' => 'Username',
            'password' => 'Password',
            'nama' => 'Nama Lengkap',
        ];
    }
}