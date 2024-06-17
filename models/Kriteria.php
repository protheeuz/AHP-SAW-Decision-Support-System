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
            [['kode_kriteria', 'keterangan', 'jenis'], 'string', 'max' => 255],
            [['bobot'], 'integer', 'min' => 1, 'max' => 20],
            ['bobot', function ($attribute, $params, $validator) {
                if ($this->getTotalSubKriteriaWeight() > $this->$attribute) {
                    $this->addError($attribute, 'Total sub-kriteria weight exceeds the main criteria weight.');
                }
            }]
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

    public function getTotalSubKriteriaWeight()
    {
        return SubKriteria::find()->where(['id_kriteria' => $this->id_kriteria])->sum('nilai');
    }

    public function getSubKriterias()
    {
        return $this->hasMany(SubKriteria::className(), ['id_kriteria' => 'id_kriteria']);
    }
}