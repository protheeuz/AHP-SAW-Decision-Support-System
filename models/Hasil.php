<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Hasil extends ActiveRecord
{
    public static function tableName()
    {
        return 'hasil';
    }

    public function rules()
    {
        return [
            [['id_alternatif', 'total_score'], 'required'],
            [['id_alternatif'], 'integer'],
            [['total_score'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_alternatif' => 'ID Alternatif',
            'total_score' => 'Total Score',
        ];
    }

    public function getAlternatif()
    {
        return $this->hasOne(Alternatif::class, ['id_alternatif' => 'id_alternatif']);
    }
}