<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public static function tableName()
    {
        return 'user';
    }

    public static function getUsers()
    {
        return self::find()->all();
    }

    public static function getTotal()
    {
        return self::find()->count();
    }

    public static function insertUser($data = [])
    {
        $model = new self();
        $model->attributes = $data;
        return $model->save();
    }

    public static function getUserById($id_user)
    {
        return self::findOne($id_user);
    }

    public static function updateUser($id_user, $data = [])
    {
        $model = self::findOne($id_user);
        if ($model) {
            $model->attributes = $data;
            return $model->save();
        }
        return false;
    }

    public static function deleteUser($id_user)
    {
        return self::deleteAll(['id_user' => $id_user]);
    }

    public static function getUserLevels()
    {
        return UserLevel::find()->all();
    }

    public function rules()
    {
        return [
            [['id_user_level', 'email', 'nama', 'username', 'password'], 'required'],
        ];
    }
}