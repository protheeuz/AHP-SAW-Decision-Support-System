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

        if (Yii::$app->request->post()) {
            $postData = Yii::$app->request->post('Penilaian');
            foreach ($postData as $id_kriteria => $nilai) {
                $penilaian = new Penilaian();
                $penilaian->id_alternatif = $id_alternatif;
                $penilaian->id_kriteria = $id_kriteria;
                $penilaian->nilai = $nilai;
                if (!$penilaian->save()) {
                    Yii::$app->session->setFlash('error', 'Gagal menyimpan data penilaian.');
                    return $this->redirect(['index']);
                }
            }
            Yii::$app->session->setFlash('success', 'Data penilaian berhasil disimpan.');
            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'kriteria' => $kriteria,
            'id_alternatif' => $id_alternatif,
        ]);
    }

    public function actionUpdate($id)
    {
        $kriteria = Kriteria::find()->all();
        $penilaian = Penilaian::find()->where(['id_alternatif' => $id])->all();
        $id_alternatif = $id;

        if (Yii::$app->request->post()) {
            Penilaian::deleteAll(['id_alternatif' => $id_alternatif]);
            $postData = Yii::$app->request->post('Penilaian');
            foreach ($postData as $id_kriteria => $nilai) {
                $penilaian = new Penilaian();
                $penilaian->id_alternatif = $id_alternatif;
                $penilaian->id_kriteria = $id_kriteria;
                $penilaian->nilai = $nilai;
                if (!$penilaian->save()) {
                    Yii::$app->session->setFlash('error', 'Gagal mengupdate data penilaian.');
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
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Alternatif::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}