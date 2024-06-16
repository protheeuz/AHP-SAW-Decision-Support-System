<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Penilaian;
use app\models\Alternatif;
use app\models\Kriteria;
use yii\data\ActiveDataProvider;

class PenilaianController extends Controller
{
    public function actionIndex()
    {
        $alternatif = Alternatif::find()->all();
        $kriteria = Kriteria::find()->all();

        return $this->render('index', [
            'alternatif' => $alternatif,
            'kriteria' => $kriteria,
        ]);
    }

    public function actionCreate()
    {
        $model = new Penilaian();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Data berhasil disimpan!');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Penilaian::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Data berhasil diupdate!');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        Penilaian::findOne($id)->delete();
        Yii::$app->session->setFlash('success', 'Data berhasil dihapus!');
        return $this->redirect(['index']);
    }
}