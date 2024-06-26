<?php

namespace app\models;

use yii\db\ActiveRecord;

class Alternatif extends ActiveRecord
{
    public static function tableName()
    {
        return 'alternatif';
    }

    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['nama'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_alternatif' => 'ID Alternatif', // Sesuaikan label dengan nama kolom yang benar
            'nama' => 'Nama Karyawan',
        ];
    }
}