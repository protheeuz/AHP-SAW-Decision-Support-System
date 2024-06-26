<?php

namespace app\models;

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
            [['id_alternatif', 'nilai'], 'required'],
            [['id_alternatif'], 'integer'],
            [['nilai'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_alternatif' => 'Alternatif',
            'nilai' => 'Nilai',
        ];
    }

    public function getAlternatif()
    {
        return $this->hasOne(Alternatif::class, ['id_alternatif' => 'id_alternatif']);
    }
}