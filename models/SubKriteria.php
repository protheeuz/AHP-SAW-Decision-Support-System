<?php

namespace app\models;

use yii\db\ActiveRecord;

class SubKriteria extends ActiveRecord
{
    public static function tableName()
    {
        return 'sub_kriteria';
    }

    public static function getSubKriteria()
    {
        return self::find()->all();
    }

    public static function getTotal()
    {
        return self::find()->count();
    }

    public static function insertSubKriteria($data = [])
    {
        $model = new self();
        $model->attributes = $data;
        return $model->save();
    }

    public static function getSubKriteriaById($id_sub_kriteria)
    {
        return self::findOne($id_sub_kriteria);
    }

    public static function updateSubKriteria($id_sub_kriteria, $data = [])
    {
        $model = self::findOne($id_sub_kriteria);
        if ($model) {
            $model->attributes = $data;
            return $model->save();
        }
        return false;
    }

    public static function deleteSubKriteria($id_sub_kriteria)
    {
        return self::deleteAll(['id_sub_kriteria' => $id_sub_kriteria]);
    }

    public static function getKriteria()
    {
        return Kriteria::find()->all();
    }

    public static function countKriteria()
    {
        return self::find()
            ->select(['id_kriteria', 'COUNT(deskripsi) AS jml_setoran'])
            ->groupBy(['id_kriteria'])
            ->all();
    }

    public static function dataSubKriteria($id_kriteria)
    {
        return self::find()
            ->where(['id_kriteria' => $id_kriteria])
            ->orderBy(['nilai' => SORT_DESC])
            ->all();
    }

    public function rules()
    {
        return [
            [['id_kriteria', 'deskripsi', 'nilai'], 'required'],
        ];
    }
}