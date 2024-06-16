<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Perhitungan;
use yii\data\ActiveDataProvider;

class PerhitunganController extends Controller
{
    public function actionHasil()
    {
        $hasil = Perhitungan::find()->all();

        return $this->render('hasil', [
            'hasil' => $hasil,
        ]);
    }

    public function actionCetakLaporanHasil()
    {
        $hasil = Perhitungan::find()->all();

        $pdf = new \Mpdf\Mpdf();
        $pdf->WriteHTML($this->renderPartial('laporan_hasil', [
            'hasil' => $hasil,
        ]));
        $pdf->Output('Laporan_Hasil.pdf', 'D');
        exit;
    }
}