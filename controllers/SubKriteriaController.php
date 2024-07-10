<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\SubKriteria;
use app\models\Kriteria;
use yii\web\Response;
use yii\widgets\ActiveForm;

class SubKriteriaController extends Controller
{
    public $layout = 'main_admin';

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

        $total_sub_kriteria = SubKriteria::find()->where(['id_kriteria' => $id])->sum('nilai');
        $total_bobot_kriteria = Kriteria::findOne($id)->bobot;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Data berhasil disimpan!');
            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
            'total_sub_kriteria' => $total_sub_kriteria,
            'total_bobot_kriteria' => $total_bobot_kriteria,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = SubKriteria::findOne($id);
    
        $total_sub_kriteria = SubKriteria::find()->where(['id_kriteria' => $model->id_kriteria])->andWhere(['!=', 'id_sub_kriteria', $id])->sum('nilai');
        $total_bobot_kriteria = Kriteria::findOne($model->id_kriteria)->bobot;
    
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Data berhasil diupdate!');
            return $this->redirect(['index']);
        }
    
        return $this->renderAjax('update', [
            'model' => $model,
            'total_sub_kriteria' => $total_sub_kriteria,
            'total_bobot_kriteria' => $total_bobot_kriteria,
        ]);
    }

    public function actionDelete($id)
    {
        SubKriteria::findOne($id)->delete();
        Yii::$app->session->setFlash('success', 'Data berhasil dihapus!');
        return $this->redirect(['index']);
    }
}