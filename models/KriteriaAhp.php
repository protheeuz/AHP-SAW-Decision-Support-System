<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class KriteriaAhp extends ActiveRecord
{
    public static function tableName()
    {
        return 'kriteria_ahp';
    }

    public function rules()
    {
        return [
            [['id_kriteria_1', 'id_kriteria_2', 'nilai'], 'required'],
            [['id_kriteria_1', 'id_kriteria_2'], 'integer'],
            [['nilai'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_kriteria_1' => 'Kriteria 1',
            'id_kriteria_2' => 'Kriteria 2',
            'nilai' => 'Nilai',
        ];
    }
}