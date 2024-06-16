<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Perhitungan;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;

class LaporanController extends Controller
{
    public function actionCetakLaporanHasil()
    {
        // Debugging
        var_dump(class_exists('Mpdf\Mpdf')); 
        var_dump(class_exists('Mpdf\Output\Destination')); 

        $hasil = Perhitungan::find()->all();
        $mpdf = new Mpdf();

        $mpdf->WriteHTML($this->renderPartial('laporan_hasil', [
            'hasil' => $hasil,
        ]));

        $mpdf->Output('Laporan_Hasil.pdf', Destination::INLINE);
    }
}