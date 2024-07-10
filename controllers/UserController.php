<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\UserLevel;
use yii\data\ActiveDataProvider;

class UserController extends Controller
{
    public $layout = 'main_admin';

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new User();
        $userLevels = UserLevel::find()->all();

        if ($model->load(Yii::$app->request->post())) {
            $model->password = Yii::$app->security->generatePasswordHash($model->password);
            if ($model->save()) {
                Yii::$app->session->addFlash('success', 'Data berhasil disimpan!');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'userLevels' => $userLevels,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = User::findOne($id);
        $userLevels = UserLevel::find()->all();

        if ($model->load(Yii::$app->request->post())) {
            if (!empty($model->password)) {
                $model->password = Yii::$app->security->generatePasswordHash($model->password);
            } else {
                $model->password = $model->getOldAttribute('password');
            }

            if ($model->save()) {
                Yii::$app->session->addFlash('success', 'Data berhasil diupdate!');
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'userLevels' => $userLevels,
        ]);
    }

    public function actionDelete($id)
    {
        User::findOne($id)->delete();
        Yii::$app->session->addFlash('success', 'Data berhasil dihapus!');
        return $this->redirect(['index']);
    }

    public function actionView($id)
    {
        $model = User::findOne($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }
}