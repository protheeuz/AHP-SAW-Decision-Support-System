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
            [['id_alternatif', 'id_kriteria', 'nilai', 'tahun'], 'required'],
            [['id_alternatif', 'id_kriteria', 'nilai', 'tahun'], 'integer'],
            [['id_kriteria'], 'exist', 'skipOnError' => true, 'targetClass' => Kriteria::class, 'targetAttribute' => ['id_kriteria' => 'id_kriteria']],
            [['id_alternatif'], 'exist', 'skipOnError' => true, 'targetClass' => Alternatif::class, 'targetAttribute' => ['id_alternatif' => 'id_alternatif']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_penilaian' => 'ID Penilaian',
            'id_alternatif' => 'Nama Karyawan',
            'id_kriteria' => 'Kriteria',
            'nilai' => 'Nilai',
            'tahun' => 'Tahun',
        ];
    }

    // Menambahkan relasi ke model Alternatif
    public function getAlternatif()
    {
        return $this->hasOne(Alternatif::class, ['id_alternatif' => 'id_alternatif']);
    }

    // Menambahkan relasi ke model Kriteria
    public function getKriteria()
    {
        return $this->hasOne(Kriteria::class, ['id_kriteria' => 'id_kriteria']);
    }
}
