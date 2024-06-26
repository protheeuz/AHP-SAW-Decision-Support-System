<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Yii;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['id_user_level', 'email', 'nama', 'username', 'password_hash'], 'required'],
            [['id_user_level'], 'integer'],
            [['email', 'nama', 'username', 'password_hash', 'auth_key', 'access_token'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_user_level' => 'User Level',
            'email' => 'Email',
            'nama' => 'Name',
            'username' => 'Username',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
        ];
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        // Assuming passwords are stored hashed
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
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
}
