<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Perhitungan;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;

class LaporanController extends Controller
{
    public $layout = 'main_admin'; // Menambahkan layout
    
    public function actionCetakLaporanHasil()
    {
        $hasil = Perhitungan::find()->all();
        $mpdf = new Mpdf();

        $mpdf->WriteHTML($this->renderPartial('laporan_hasil', [
            'hasil' => $hasil,
        ]));

        $mpdf->Output('Laporan_Hasil.pdf', Destination::INLINE);
    }
}