<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Kriteria extends ActiveRecord
{
    public static function tableName()
    {
        return 'kriteria';
    }

    public function rules()
    {
        return [
            [['kode_kriteria', 'keterangan', 'jenis'], 'required'],
            [['kode_kriteria', 'keterangan', 'jenis'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_kriteria' => 'ID',
            'kode_kriteria' => 'Kode Kriteria',
            'keterangan' => 'Nama Kriteria',
            'jenis' => 'Jenis Kriteria',
            'bobot' => 'Bobot',
        ];
    }
}