<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Penilaian;
use app\models\Alternatif;
use app\models\Kriteria;
use yii\web\NotFoundHttpException;

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
        $kriteria = Kriteria::find()->all();
        $id_alternatif = $id;

        $model = new Penilaian(); // Inisialisasi model Penilaian

        if (Yii::$app->request->post()) {
            $postData = Yii::$app->request->post('Penilaian');
            Yii::info('Post data: ' . json_encode($postData), __METHOD__);

            foreach ($postData as $id_kriteria => $nilai) {
                if (!is_numeric($id_kriteria) || !is_numeric($nilai)) {
                    Yii::$app->session->setFlash('error', 'Data kriteria atau nilai tidak valid.');
                    return $this->redirect(['index']);
                }

                // Validasi id_kriteria
                $kriteriaModel = Kriteria::findOne($id_kriteria);
                if (!$kriteriaModel) {
                    Yii::$app->session->setFlash('error', 'ID kriteria tidak valid.');
                    return $this->redirect(['index']);
                }

                $penilaian = new Penilaian();
                $penilaian->id_alternatif = $id_alternatif;
                $penilaian->id_kriteria = (int)$id_kriteria;
                $penilaian->nilai = (int)$nilai;

                Yii::info('Saving Penilaian: ' . json_encode($penilaian->attributes), __METHOD__);
                if (!$penilaian->save()) {
                    Yii::error("Failed to save penilaian: " . json_encode($penilaian->errors), __METHOD__);
                    Yii::$app->session->setFlash('error', 'Gagal menyimpan data penilaian: ' . json_encode($penilaian->errors));
                    return $this->redirect(['index']);
                }
            }
            Yii::$app->session->setFlash('success', 'Data penilaian berhasil disimpan.');
            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'kriteria' => $kriteria,
            'id_alternatif' => $id_alternatif,
            'model' => $model, // Kirimkan model ke view
        ]);
    }

    public function actionUpdate($id)
    {
        $kriteria = Kriteria::find()->all();
        $penilaian = Penilaian::find()->where(['id_alternatif' => $id])->all();
        $id_alternatif = $id;

        $model = new Penilaian(); // Inisialisasi model Penilaian

        if (Yii::$app->request->post()) {
            $postData = Yii::$app->request->post('Penilaian');
            Yii::info('Post data: ' . json_encode($postData), __METHOD__);

            // Delete existing penilaian
            Penilaian::deleteAll(['id_alternatif' => $id_alternatif]);

            foreach ($postData as $id_kriteria => $nilai) {
                if (!is_numeric($id_kriteria) || !is_numeric($nilai)) {
                    Yii::$app->session->setFlash('error', 'Data kriteria atau nilai tidak valid.');
                    return $this->redirect(['index']);
                }

                // Validasi id_kriteria
                $kriteriaModel = Kriteria::findOne($id_kriteria);
                if (!$kriteriaModel) {
                    Yii::$app->session->setFlash('error', 'ID kriteria tidak valid.');
                    return $this->redirect(['index']);
                }

                $penilaian = new Penilaian();
                $penilaian->id_alternatif = $id_alternatif;
                $penilaian->id_kriteria = (int)$id_kriteria;
                $penilaian->nilai = (int)$nilai;

                Yii::info('Saving Penilaian: ' . json_encode($penilaian->attributes), __METHOD__);
                if (!$penilaian->save()) {
                    Yii::error("Failed to save penilaian: " . json_encode($penilaian->errors), __METHOD__);
                    Yii::$app->session->setFlash('error', 'Gagal menyimpan data penilaian: ' . json_encode($penilaian->errors));
                    return $this->redirect(['index']);
                }
            }
            Yii::$app->session->setFlash('success', 'Data penilaian berhasil diupdate.');
            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'kriteria' => $kriteria,
            'penilaian' => $penilaian,
            'id_alternatif' => $id_alternatif,
            'model' => $model, // Kirimkan model ke view
        ]);
    }
}
