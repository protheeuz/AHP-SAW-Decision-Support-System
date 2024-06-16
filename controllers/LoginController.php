<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\User;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class LoginController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'home'],
                'rules' => [
                    [
                        'actions' => ['logout', 'home'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['home']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['home']);
        } else {
            return $this->render('login', ['model' => $model]);
        }
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['home']);
        } else {
            Yii::$app->session->setFlash('error', 'Username atau Password Salah');
            return $this->redirect(['index']);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionHome()
    {
        return $this->render('home', ['page' => 'Dashboard']);
    }
}