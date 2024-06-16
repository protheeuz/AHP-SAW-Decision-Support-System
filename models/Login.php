<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Login extends ActiveRecord
{
    public static function tableName()
    {
        return 'user';
    }

    public static function loggedId()
    {
        return Yii::$app->user->id;
    }

    public static function login($username, $password)
    {
        return self::find()
            ->where(['username' => $username, 'password' => $password])
            ->one();
    }

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
        ];
    }
}