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
            [['id_kriteria'], 'exist', 'skipOnError' => true, 'targetClass' => Kriteria::class, 'targetAttribute' => ['id_kriteria' => 'id_kriteria']],
            [['id_alternatif'], 'exist', 'skipOnError' => true, 'targetClass' => Alternatif::class, 'targetAttribute' => ['id_alternatif' => 'id_alternatif']],
        ];
    }


    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        Yii::info('Before Saving Penilaian: ' . json_encode($this->attributes), __METHOD__);
        return true;
    }



    public function attributeLabels()
    {
        return [
            'id_penilaian' => 'ID Penilaian',
            'id_alternatif' => 'ID Alternatif',
            'id_kriteria' => 'ID Kriteria',
            'nilai' => 'Nilai',
        ];
    }
}
