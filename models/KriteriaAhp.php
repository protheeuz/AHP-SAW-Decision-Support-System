<?php

namespace app\models;

use yii\db\ActiveRecord;

class KriteriaAhp extends ActiveRecord
{
    public static function tableName()
    {
        return 'kriteria_ahp';
    }

    public static function getKriteriaAhp($id_kriteria_1, $id_kriteria_2)
    {
        return self::find()->where(['id_kriteria_1' => $id_kriteria_1, 'id_kriteria_2' => $id_kriteria_2])->one();
    }

    public function rules()
    {
        return [
            [['id_kriteria_1', 'id_kriteria_2'], 'required'],
        ];
    }
}
