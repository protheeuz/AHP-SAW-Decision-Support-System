<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Perhitungan;
use app\models\Hasil;
use yii\data\ActiveDataProvider;

class PerhitunganController extends Controller
{
    public $layout = 'main_admin'; // Menambahkan layout
    
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Perhitungan::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionHasil()
    {
        $hasil = Hasil::find()->with('alternatif')->all();

        return $this->render('hasil', [
            'hasil' => $hasil,
        ]);
    }

    public function actionCetakLaporanHasil()
    {
        $hasil = Hasil::find()->with('alternatif')->all();

        $pdf = new \Mpdf\Mpdf();
        $pdf->WriteHTML($this->renderPartial('laporan_hasil', [
            'hasil' => $hasil,
        ]));
        $pdf->Output('Laporan_Hasil.pdf', 'D');
        exit;
    }
}