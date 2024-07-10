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
            [['kode_kriteria', 'keterangan', 'jenis', 'bobot'], 'required'],
            [['bobot'], 'integer'],
            [['kode_kriteria'], 'string', 'max' => 10],
            [['keterangan'], 'string', 'max' => 255],
            [['jenis'], 'string', 'max' => 10],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_kriteria' => 'ID Kriteria',
            'kode_kriteria' => 'Kode Kriteria',
            'keterangan' => 'Keterangan',
            'jenis' => 'Jenis',
            'bobot' => 'Bobot',
        ];
    }

    public function getSubKriterias()
    {
        return $this->hasMany(SubKriteria::class, ['id_kriteria' => 'id_kriteria']);
    }
}