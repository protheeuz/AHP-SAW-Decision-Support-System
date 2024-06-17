<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Penilaian;
use app\models\Kriteria;
use app\models\Alternatif;

class PenilaianController extends Controller
{
    public $layout = 'main_admin'; // Menambahkan layout

    public function actionIndex()
    {
        $alternatif = Alternatif::find()->all();

        return $this->render('index', [
            'alternatif' => $alternatif,
        ]);
    }

    public function actionCreate($id)
    {
        $kriteria = Kriteria::find()->all();
        $model = new Penilaian();

        if (Yii::$app->request->post()) {
            $data = Yii::$app->request->post('Penilaian');
            foreach ($data as $id_kriteria => $nilai) {
                $penilaian = new Penilaian();
                $penilaian->id_alternatif = $id;
                $penilaian->id_kriteria = $id_kriteria;
                $penilaian->nilai = $nilai;
                $penilaian->save();
            }
            Yii::$app->session->setFlash('success', 'Data penilaian berhasil disimpan.');
            return $this->redirect(['index']);
        }

        return $this->renderAjax('form', [
            'kriteria' => $kriteria,
            'id_alternatif' => $id,
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $kriteria = Kriteria::find()->all();
        $penilaian = Penilaian::findAll(['id_alternatif' => $id]);

        if (Yii::$app->request->post()) {
            Penilaian::deleteAll(['id_alternatif' => $id]);
            $data = Yii::$app->request->post('Penilaian');
            foreach ($data as $id_kriteria => $nilai) {
                $penilaian = new Penilaian();
                $penilaian->id_alternatif = $id;
                $penilaian->id_kriteria = $id_kriteria;
                $penilaian->nilai = $nilai;
                $penilaian->save();
            }
            Yii::$app->session->setFlash('success', 'Data penilaian berhasil diupdate.');
            return $this->redirect(['index']);
        }

        return $this->renderAjax('form', [
            'kriteria' => $kriteria,
            'id_alternatif' => $id,
            'penilaian' => $penilaian,
        ]);
    }
}