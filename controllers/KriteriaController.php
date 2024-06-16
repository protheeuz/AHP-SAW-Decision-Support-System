<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Kriteria;
use yii\data\ActiveDataProvider;

class KriteriaController extends Controller
{
    public $layout = 'main_admin'; // Menambahkan layout
    
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Kriteria::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Kriteria();

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
        $model = Kriteria::findOne($id);

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
        Kriteria::findOne($id)->delete();
        Yii::$app->session->setFlash('success', 'Data berhasil dihapus!');
        return $this->redirect(['index']);
    }

    public function actionPrioritas()
    {
        // Logika untuk prioritas
        return $this->render('prioritas');
    }

    public function actionReset()
    {
        // Logika untuk reset
        Yii::$app->session->setFlash('success', 'Data berhasil direset!');
        return $this->redirect(['prioritas']);
    }
}