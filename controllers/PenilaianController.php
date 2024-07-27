<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Penilaian;
use app\models\Alternatif;
use app\models\Kriteria;

class PenilaianController extends Controller
{
    public $layout = 'main_admin';

    public function actionIndex()
    {
        $alternatif = Alternatif::find()->all();
        return $this->render('index', [
            'alternatif' => $alternatif,
        ]);
    }

    public function actionCreate($id)
    {
        if (Yii::$app->user->identity->id_user_level == 3) { // Jika user adalah Karyawan
            Yii::$app->session->addFlash('error', 'Anda tidak memiliki akses untuk menambah penilaian.');
            return $this->redirect(['index']);
        }

        $kriteria = Kriteria::find()->all();
        $id_alternatif = $id;

        if (Yii::$app->request->isAjax && Yii::$app->request->isPost) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $postData = Yii::$app->request->post('Penilaian');
            foreach ($postData as $id_kriteria => $nilai) {
                $penilaian = new Penilaian();
                $penilaian->id_alternatif = $id_alternatif;
                $penilaian->id_kriteria = (int)$id_kriteria;
                $penilaian->nilai = (int)$nilai;
                if (!$penilaian->save()) {
                    return ['success' => false, 'message' => 'Gagal menyimpan data penilaian: ' . json_encode($penilaian->errors)];
                }
            }
            return ['success' => true, 'message' => 'Data penilaian berhasil disimpan.'];
        }

        return $this->renderAjax('create', [
            'kriteria' => $kriteria,
            'id_alternatif' => $id_alternatif,
        ]);
    }

    public function actionUpdate($id)
    {
        if (Yii::$app->user->identity->id_user_level == 3) { // Jika user adalah Karyawan
            Yii::$app->session->addFlash('error', 'Anda tidak memiliki akses untuk mengedit penilaian.');
            return $this->redirect(['index']);
        }

        $kriteria = Kriteria::find()->all();
        $penilaian = Penilaian::find()->where(['id_alternatif' => $id])->all();
        $id_alternatif = $id;

        if (Yii::$app->request->isAjax && Yii::$app->request->isPost) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            Penilaian::deleteAll(['id_alternatif' => $id_alternatif]);

            $postData = Yii::$app->request->post('Penilaian');
            foreach ($postData as $id_kriteria => $nilai) {
                $penilaian = new Penilaian();
                $penilaian->id_alternatif = $id_alternatif;
                $penilaian->id_kriteria = (int)$id_kriteria;
                $penilaian->nilai = (int)$nilai;
                if (!$penilaian->save()) {
                    return ['success' => false, 'message' => 'Gagal menyimpan data penilaian: ' . json_encode($penilaian->errors)];
                }
            }
            return ['success' => true, 'message' => 'Data penilaian berhasil diupdate.'];
        }

        return $this->renderAjax('update', [
            'kriteria' => $kriteria,
            'penilaian' => $penilaian,
            'id_alternatif' => $id_alternatif,
        ]);
    }
}
