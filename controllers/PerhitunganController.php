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

    public function actionHasil()
    {
        $alternatif = Alternatif::find()->all();
        $kriteria = Kriteria::find()->all();
        $penilaian = Penilaian::find()->all();

        $scores = $this->calculateScores($alternatif, $kriteria, $penilaian);
        $kriteriaScores = $this->getKriteriaScores($alternatif, $kriteria, $penilaian);
        $divisiScores = $this->getDivisiScores($alternatif, $kriteria, $penilaian);

        return $this->render('hasil', [
            'scores' => $scores,
            'kriteriaScores' => $kriteriaScores,
            'divisiScores' => $divisiScores,
        ]);
    }

    private function getDivisiScores($alternatif, $kriteria, $penilaian)
    {
        $divisiScores = [];
        foreach ($kriteria as $krit) {
            $divisiData = [];
            foreach ($alternatif as $alt) {
                foreach ($penilaian as $pen) {
                    if ($pen->id_alternatif == $alt->id_alternatif && $pen->id_kriteria == $krit->id_kriteria) {
                        if (!isset($divisiData[$alt->divisi])) {
                            $divisiData[$alt->divisi] = [];
                        }
                        $divisiData[$alt->divisi][] = $pen->nilai;
                    }
                }
            }

            foreach ($divisiData as $divisi => $nilaiArray) {
                $divisiScores[$krit->keterangan][$divisi] = array_sum($nilaiArray) / count($nilaiArray); // Menghitung rata-rata nilai per divisi
            }
        }

        return $divisiScores;
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