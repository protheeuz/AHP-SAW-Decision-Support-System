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

    public static function getPenilaianByAlternatif($id_alternatif)
    {
        return self::find()->where(['id_alternatif' => $id_alternatif])->all();
    }

    public static function calculateScores($alternatif)
    {
        $scores = [];
        $kriteria = Kriteria::find()->all();

        foreach ($alternatif as $alt) {
            $total_score = 0;
            foreach ($kriteria as $krit) {
                $penilaian = self::findOne(['id_alternatif' => $alt->id_alternatif, 'id_kriteria' => $krit->id_kriteria]);
                if ($penilaian) {
                    $total_score += $penilaian->nilai * $krit->bobot / 100;
                }
            }
            $scores[] = [
                'nama' => $alt->nama,
                'total_score' => $total_score,
            ];
        }

        // Mengurutkan hasil berdasarkan skor total dari yang tertinggi ke terendah
        usort($scores, function ($a, $b) {
            return $b['total_score'] <=> $a['total_score'];
        });

        return $scores;
    }
    public function getAlternatif()
    {
        return $this->hasOne(Alternatif::class, ['id_alternatif' => 'id_alternatif']);
    }

    public function getKriteria()
    {
        return $this->hasOne(Kriteria::class, ['id_kriteria' => 'id_kriteria']);
    }
}
