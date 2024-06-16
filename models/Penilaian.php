<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Penilaian extends ActiveRecord
{
    public static function tableName()
    {
        return 'penilaian';
    }

    public function rules()
    {
        return [
            [['id_alternatif', 'id_kriteria', 'nilai'], 'required'],
            [['id_alternatif', 'id_kriteria', 'nilai'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_penilaian' => 'ID',
            'id_alternatif' => 'Alternatif',
            'id_kriteria' => 'Kriteria',
            'nilai' => 'Nilai',
        ];
    }
}