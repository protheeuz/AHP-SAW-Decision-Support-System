<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Profile;
use yii\data\ActiveDataProvider;

class ProfileController extends Controller
{
    public $layout = 'main_admin'; // Menambahkan layout
    
    public function actionIndex()
    {
        $id_user = Yii::$app->user->id;
        $profile = Profile::findOne($id_user);

        return $this->render('index', [
            'profile' => $profile,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Profile::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Data berhasil diupdate!');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
}