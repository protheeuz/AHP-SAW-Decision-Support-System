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
    
        // Load data yang dibutuhkan untuk form
        $total_sub_kriteria = SubKriteria::find()->where(['id_kriteria' => $id])->sum('nilai');
        $total_bobot_kriteria = Kriteria::findOne($id)->bobot;
    
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('success', 'Data berhasil disimpan!');
                return $this->redirect(['index']);
            } else {
                // Menampilkan pesan kesalahan
                Yii::$app->session->setFlash('error', 'Total nilai sub-kriteria tidak bisa melebihi bobot kriteria.');
            }
        }
    
        // Render view create dengan model dan data yang diperlukan
        return $this->renderAjax('create', [
            'model' => $model,
            'total_sub_kriteria' => $total_sub_kriteria,
            'total_bobot_kriteria' => $total_bobot_kriteria,
        ]);
    }
    public function actionUpdate($id)
    {
        $model = SubKriteria::findOne($id);

        // Hitung total bobot sub-kriteria yang sudah ada untuk kriteria ini, tidak termasuk nilai sub-kriteria ini sendiri
        $total_sub_kriteria = SubKriteria::find()->where(['id_kriteria' => $model->id_kriteria])->andWhere(['!=', 'id_sub_kriteria', $id])->sum('nilai');
        // Ambil total bobot untuk kriteria ini
        $total_bobot_kriteria = Kriteria::findOne($model->id_kriteria)->bobot;

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
