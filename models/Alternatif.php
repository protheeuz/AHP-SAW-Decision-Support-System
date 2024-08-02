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
            [['nama', 'divisi'], 'required'],
            [['nama', 'divisi'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_alternatif' => 'ID Alternatif',
            'nama' => 'Nama Karyawan',
            'divisi' => 'Divisi',
        ];
    }
}