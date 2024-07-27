<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\UserLevel;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class UserController extends Controller
{
    public $layout = 'main_admin';

    public function actionIndex()
    {
        $query = User::find();

        // Jika pengguna adalah Kepala Bagian atau Karyawan, hanya tampilkan data mereka sendiri
        if (Yii::$app->user->identity->id_user_level == 2 || Yii::$app->user->identity->id_user_level == 3) {
            $query->andWhere(['id_user' => Yii::$app->user->identity->id]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        // Hanya Admin yang bisa mengakses aksi create
        if (Yii::$app->user->identity->id_user_level != 1) {
            Yii::$app->session->addFlash('error', 'Anda tidak diizinkan untuk menambah data user.');
            return $this->redirect(['index']);
        }

        $model = new User();
        $userLevels = UserLevel::find()->all();

        if ($model->load(Yii::$app->request->post())) {
            $model->password = Yii::$app->security->generatePasswordHash($model->password);
            if ($model->save()) {
                Yii::$app->session->addFlash('success', 'Data berhasil disimpan!');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->addFlash('error', 'Gagal menyimpan data.');
            }
        }

        return $this->render('create', [
            'model' => $model,
            'userLevels' => $userLevels,
        ]);
    }

    public function actionUpdate($id)
    {
        // Pastikan pengguna hanya dapat mengedit data mereka sendiri jika mereka bukan Admin
        if (Yii::$app->user->identity->id_user_level != 1 && $id != Yii::$app->user->identity->id) {
            throw new NotFoundHttpException('Anda tidak diizinkan untuk mengedit data ini.');
        }

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
        // Pastikan hanya Admin yang dapat menghapus data
        if (Yii::$app->user->identity->id_user_level != 1) {
            throw new NotFoundHttpException('Anda tidak diizinkan untuk menghapus data ini.');
        }

        User::findOne($id)->delete();
        Yii::$app->session->addFlash('success', 'Data berhasil dihapus!');
        return $this->redirect(['index']);
    }

    public function actionView($id)
    {
        // Pastikan pengguna hanya dapat melihat data mereka sendiri jika mereka bukan Admin
        if (Yii::$app->user->identity->id_user_level != 1 && $id != Yii::$app->user->identity->id) {
            throw new NotFoundHttpException('Anda tidak diizinkan untuk melihat data ini.');
        }

        $model = User::findOne($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }
}