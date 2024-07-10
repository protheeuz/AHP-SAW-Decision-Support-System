<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class SubKriteria extends ActiveRecord
{
    public static function tableName()
    {
        return 'sub_kriteria';
    }

    public function rules()
    {
        return [
            [['id_kriteria', 'deskripsi', 'nilai'], 'required'],
            [['id_kriteria'], 'integer'],
            [['nilai'], 'number', 'min' => 1],
            [['deskripsi'], 'string', 'max' => 255],
            ['nilai', 'validateTotalWeight']
        ];
    }

    public function validateTotalWeight($attribute, $params, $validator)
    {
        $totalSubKriteriaWeight = SubKriteria::find()
            ->where(['id_kriteria' => $this->id_kriteria])
            ->andWhere(['not', ['id_sub_kriteria' => $this->id_sub_kriteria]])
            ->sum('nilai') + $this->$attribute;
        $mainKriteriaWeight = Kriteria::findOne($this->id_kriteria)->bobot;
        if ($totalSubKriteriaWeight > $mainKriteriaWeight) {
            $this->addError($attribute, 'Total nilai sub-kriteria tidak bisa melebihi bobot kriteria.');
        }
    }

    public function attributeLabels()
    {
        return [
            'id_sub_kriteria' => 'ID',
            'id_kriteria' => 'Kriteria',
            'deskripsi' => 'Deskripsi',
            'nilai' => 'Nilai',
        ];
    }
}