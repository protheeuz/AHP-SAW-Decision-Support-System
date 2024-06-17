<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\SubKriteria;
use app\models\Kriteria;

class SubKriteriaController extends Controller
{
    public $layout = 'main_admin'; // Menambahkan layout

    public function actionIndex()
    {
        $kriteria = Kriteria::find()->all();

        return $this->render('index', [
            'kriteria' => $kriteria,
        ]);
    }

    public function actionCreate($id)
    {
        $model = new SubKriteria();
        $model->id_kriteria = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Data berhasil disimpan!');
            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = SubKriteria::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Data berhasil diupdate!');
            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        SubKriteria::findOne($id)->delete();
        Yii::$app->session->setFlash('success', 'Data berhasil dihapus!');
        return $this->redirect(['index']);
    }
}