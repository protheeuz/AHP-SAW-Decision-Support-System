<?php

namespace app\models;

use yii\db\ActiveRecord;

class UserLevel extends ActiveRecord
{
    public static function tableName()
    {
        return 'user_level'; // sesuaikan dengan nama tabel Anda
    }

    public function rules()
    {
        return [
            [['user_level'], 'required'],
            [['user_level'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_level' => 'User Level',
        ];
    }
}

