<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Alternatif;
use app\models\Kriteria;
use app\models\Penilaian;
use yii\data\ActiveDataProvider;

class PerhitunganController extends Controller
{
    public $layout = 'main_admin';

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Penilaian::find()
                ->joinWith('alternatif')
                ->where(['not', ['alternatif.id_alternatif' => null]])
                ->with(['kriteria']),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    private function getDivisiScores($alternatif, $kriteria, $penilaian)
    {
        $divisiScores = [];

        foreach ($kriteria as $krit) {
            foreach ($alternatif as $alt) {
                foreach ($penilaian as $pen) {
                    if ($pen->id_alternatif == $alt->id_alternatif && $pen->id_kriteria == $krit->id_kriteria) {
                        $divisi = $alt->divisi; // Asumsikan ada atribut 'divisi' pada model Alternatif
                        if (!isset($divisiScores[$krit->keterangan][$divisi])) {
                            $divisiScores[$krit->keterangan][$divisi] = [];
                        }
                        $divisiScores[$krit->keterangan][$divisi][] = $pen->nilai;
                    }
                }
            }
        }

        // Hitung rata-rata untuk setiap divisi pada setiap kriteria
        foreach ($divisiScores as $kriteria => $divisiData) {
            foreach ($divisiData as $divisi => $scores) {
                $divisiScores[$kriteria][$divisi] = array_sum($scores) / count($scores);
            }
        }

        return $divisiScores;
    }

    // Di PerhitunganController.php
    public function actionHasil()
    {
        $alternatif = Alternatif::find()->all();
        $kriteria = Kriteria::find()->all();
        $penilaian = Penilaian::find()->all();

        Yii::debug($alternatif, 'alternatif');
        Yii::debug($kriteria, 'kriteria');
        Yii::debug($penilaian, 'penilaian');

        $scores = $this->calculateScores($alternatif, $kriteria, $penilaian);
        $kriteriaScores = $this->getKriteriaScores($alternatif, $kriteria, $penilaian);
        $divisiScores = $this->calculateDivisiScores($alternatif, $kriteria, $penilaian);

        Yii::debug($divisiScores, 'divisiScores');

        return $this->render('hasil', [
            'scores' => $scores,
            'kriteriaScores' => $kriteriaScores,
            'divisiScores' => $divisiScores,
        ]);
    }

    private function calculateDivisiScores($alternatif, $kriteria, $penilaian)
    {
        $divisiScores = [];

        foreach ($kriteria as $krit) {
            foreach ($alternatif as $alt) {
                foreach ($penilaian as $pen) {
                    if ($pen->id_alternatif == $alt->id_alternatif && $pen->id_kriteria == $krit->id_kriteria) {
                        $divisi = $alt->divisi;
                        $year = $pen->tahun;

                        if (!isset($divisiScores[$krit->keterangan][$divisi][$year])) {
                            $divisiScores[$krit->keterangan][$divisi][$year] = 0;
                        }

                        $divisiScores[$krit->keterangan][$divisi][$year] += $pen->nilai;
                    }
                }
            }
        }

        // Rata-rata nilai per tahun per divisi
        foreach ($divisiScores as $kriteria => $divisiData) {
            foreach ($divisiData as $divisi => $yearData) {
                foreach ($yearData as $year => $totalScore) {
                    $divisiScores[$kriteria][$divisi][$year] = $totalScore;
                }
            }
        }

        return $divisiScores;
    }

    private function getYearlyScores($alternatif, $penilaian)
    {
        $yearlyScores = [];
        foreach ($alternatif as $alt) {
            $scores = [];
            foreach ($penilaian as $pen) {
                if ($pen->id_alternatif == $alt->id_alternatif) {
                    $year = $pen->tahun;
                    if (!isset($scores[$year])) {
                        $scores[$year] = 0;
                    }
                    $scores[$year] += $pen->nilai;
                }
            }
            foreach ($scores as $year => $totalScore) {
                $yearlyScores[$alt->nama][$year] = $totalScore;
            }
        }
        return $yearlyScores;
    }

    private function getKriteriaScores($alternatif, $kriteria, $penilaian)
    {
        $kriteriaScores = [];
        foreach ($kriteria as $krit) {
            $scores = [];
            foreach ($alternatif as $alt) {
                foreach ($penilaian as $pen) {
                    if ($pen->id_alternatif == $alt->id_alternatif && $pen->id_kriteria == $krit->id_kriteria) {
                        $year = $pen->tahun;
                        if (!isset($scores[$year])) {
                            $scores[$year] = [];
                        }
                        $scores[$year][] = [
                            'nama' => $alt->nama,
                            'nilai' => $pen->nilai,
                        ];
                    }
                }
            }
            foreach ($scores as $year => $yearScores) {
                usort($yearScores, function ($a, $b) {
                    return $b['nilai'] <=> $a['nilai'];
                });
            }
            $kriteriaScores[$krit->keterangan] = $scores;
        }
        return $kriteriaScores;
    }

    private function calculateScores($alternatif, $kriteria, $penilaian)
    {
        $scores = [];

        foreach ($alternatif as $alt) {
            $totalScore = 0;
            foreach ($kriteria as $krit) {
                $nilai = 0;
                foreach ($penilaian as $pen) {
                    if ($pen->id_alternatif == $alt->id_alternatif && $pen->id_kriteria == $krit->id_kriteria) {
                        $nilai = $pen->nilai;
                        break;
                    }
                }
                $totalScore += $nilai * ($krit->bobot / 100);
            }
            $scores[] = [
                'nama' => $alt->nama,
                'total_score' => $totalScore,
            ];
        }

        usort($scores, function ($a, $b) {
            return $b['total_score'] <=> $a['total_score'];
        });

        return $scores;
    }
}
