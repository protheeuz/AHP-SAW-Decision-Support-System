<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Kriteria;
use app\models\SubKriteria;
use app\models\Alternatif;
use app\models\User;

class AdminController extends Controller
{
    public function actionIndex()
    {
        $num = Kriteria::find()->count();
        $sub = SubKriteria::find()->count();
        $alternatif = Alternatif::find()->count();
        $user = User::find()->count();

        return $this->render('index', [
            'num' => $num,
            'sub' => $sub,
            'alternatif' => $alternatif,
            'user' => $user,
        ]);
    }
}
