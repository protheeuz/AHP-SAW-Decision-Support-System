<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Kriteria;
use app\models\KriteriaAhp;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\db\Exception;

class KriteriaController extends Controller
{
    public $layout = 'main_admin';

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
            Yii::$app->session->setFlash('success', 'Data berhasil disimpan.');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id_kriteria)
    {
        $model = $this->findModel($id_kriteria);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Data berhasil diperbarui.');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionView($id_kriteria)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_kriteria),
        ]);
    }

    public function actionDelete($id_kriteria)
    {
        $this->findModel($id_kriteria)->delete();
        Yii::$app->session->setFlash('success', 'Data berhasil dihapus.');
        return $this->redirect(['index']);
    }

    protected function findModel($id_kriteria)
    {
        if (($model = Kriteria::findOne($id_kriteria)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPrioritas()
    {
        $kriteria = Kriteria::find()->all();

        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();

            if (isset($postData['comparison'])) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    KriteriaAhp::deleteAll();
                    $comparisonData = $postData['comparison'];

                    foreach ($kriteria as $i => $kriteria1) {
                        foreach ($kriteria as $j => $kriteria2) {
                            if ($i < $j && isset($comparisonData[$kriteria1->id][$kriteria2->id])) {
                                $model = new KriteriaAhp();
                                $model->id_kriteria_1 = $kriteria1->id;
                                $model->id_kriteria_2 = $kriteria2->id;
                                $model->nilai = $comparisonData[$kriteria1->id][$kriteria2->id];
                                if (!$model->save()) {
                                    $transaction->rollBack();
                                    Yii::$app->session->addFlash('error', 'Gagal menyimpan data perbandingan.');
                                    return $this->render('prioritas', ['kriteria' => $kriteria]);
                                }
                            }
                        }
                    }
                    $transaction->commit();
                    Yii::$app->session->addFlash('success', 'Data berhasil disimpan!');
                } catch (Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->session->addFlash('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
                }
            }

            if (isset($postData['check'])) {
                $id_kriteria = array_map(function ($k) {
                    return $k->id;
                }, $kriteria);
                $matrik_kriteria = $this->ahpGetMatrikKriteria($id_kriteria);
                $jumlah_kolom = $this->ahpGetJumlahKolom($matrik_kriteria);
                $matrik_normalisasi = $this->ahpGetNormalisasi($matrik_kriteria, $jumlah_kolom);
                $prioritas = $this->ahpGetPrioritas($matrik_normalisasi);
                $matrik_baris = $this->ahpGetMatrikBaris($prioritas, $matrik_kriteria);
                $jumlah_matrik_baris = $this->ahpGetJumlahMatrikBaris($matrik_baris);
                $hasil_tabel_konsistensi = $this->ahpGetTabelKonsistensi($jumlah_matrik_baris, $prioritas);
                $konsistensi_result = $this->ahpUjiKonsistensi($hasil_tabel_konsistensi);

                if ($konsistensi_result['isConsistent']) {
                    $total_prioritas = array_sum($prioritas);
                    foreach ($kriteria as $i => $row) {
                        $row->bobot = ($prioritas[$i] / $total_prioritas) * 100;
                        if (!$row->save()) {
                            Yii::$app->session->addFlash('error', 'Gagal menyimpan bobot kriteria.');
                            return $this->render('prioritas', ['kriteria' => $kriteria]);
                        }
                    }
                    Yii::$app->session->addFlash('success', 'Nilai perbandingan konsisten dan bobot berhasil diperbarui!');
                } else {
                    Yii::$app->session->addFlash('error', 'Nilai perbandingan tidak konsisten!');
                }
            }
        }

        return $this->render('prioritas', ['kriteria' => $kriteria]);
    }

    // AHP Methods
    private function ahpGetMatrikKriteria($kriteria)
    {
        $matrik = [];
        foreach ($kriteria as $i => $row1) {
            foreach ($kriteria as $j => $row2) {
                if ($i == $j) {
                    $matrik[$i][$j] = 1;
                } elseif ($i < $j) {
                    $kriteria_ahp = KriteriaAhp::findOne(['id_kriteria_1' => $row1, 'id_kriteria_2' => $row2]);
                    $matrik[$i][$j] = $kriteria_ahp ? $kriteria_ahp->nilai : 1;
                    $matrik[$j][$i] = $kriteria_ahp ? 1 / $kriteria_ahp->nilai : 1;
                }
            }
        }
        return $matrik;
    }

    private function ahpGetJumlahKolom($matrik)
    {
        $jumlah_kolom = array_fill(0, count($matrik), 0);
        foreach ($matrik as $i => $row) {
            foreach ($row as $j => $value) {
                $jumlah_kolom[$j] += $value;
            }
        }
        return $jumlah_kolom;
    }

    private function ahpGetNormalisasi($matrik, $jumlah_kolom)
    {
        $matrik_normalisasi = [];
        foreach ($matrik as $i => $row) {
            foreach ($row as $j => $value) {
                $matrik_normalisasi[$i][$j] = $value / $jumlah_kolom[$j];
            }
        }
        return $matrik_normalisasi;
    }

    private function ahpGetPrioritas($matrik_normalisasi)
    {
        $prioritas = array_fill(0, count($matrik_normalisasi), 0);
        foreach ($matrik_normalisasi as $i => $row) {
            $prioritas[$i] = array_sum($row) / count($row);
        }
        return $prioritas;
    }

    private function ahpGetMatrikBaris($prioritas, $matrik_kriteria)
    {
        $matrik_baris = [];
        foreach ($matrik_kriteria as $i => $row) {
            foreach ($row as $j => $value) {
                $matrik_baris[$i][$j] = $prioritas[$j] * $value;
            }
        }
        return $matrik_baris;
    }

    private function ahpGetJumlahMatrikBaris($matrik_baris)
    {
        $jumlah_baris = array_fill(0, count($matrik_baris), 0);
        foreach ($matrik_baris as $i => $row) {
            $jumlah_baris[$i] = array_sum($row);
        }
        return $jumlah_baris;
    }

    private function ahpGetTabelKonsistensi($jumlah_matrik_baris, $prioritas)
    {
        $tabel_konsistensi = [];
        foreach ($jumlah_matrik_baris as $i => $value) {
            $tabel_konsistensi[$i] = $value / $prioritas[$i];
        }
        return $tabel_konsistensi;
    }

    private function ahpUjiKonsistensi($tabel_konsistensi)
    {
        $jumlah = array_sum($tabel_konsistensi);
        $n = count($tabel_konsistensi);
        $lambda_maks = $jumlah / $n;
        $ci = ($lambda_maks - $n) / ($n - 1);
        $ir = [0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49, 1.51, 1.48, 1.56, 1.57, 1.59];
        $cr = $ci / ($n <= 15 ? $ir[$n - 1] : 1.59);
        return ['ci' => $ci, 'cr' => $cr, 'isConsistent' => $cr <= 0.1];
    }

    // Methods for displaying calculation steps

    public function tampilData1($matrik_kriteria, $jumlah_kolom)
    {
        $kriteria = Kriteria::find()->all();
        $list_data = '<tr><td></td>';
        foreach ($kriteria as $row) {
            $list_data .= '<td class="text-center">' . $row->kode_kriteria . '</td>';
        }
        $list_data .= '</tr>';
        foreach ($kriteria as $i => $row) {
            $list_data .= '<tr><td>' . $row->kode_kriteria . '</td>';
            foreach ($kriteria as $j => $row2) {
                $list_data .= '<td class="text-center">' . $matrik_kriteria[$i][$j] . '</td>';
            }
            $list_data .= '</tr>';
        }
        $list_data .= '<tr><td class="font-weight-bold">Jumlah</td>';
        foreach ($jumlah_kolom as $value) {
            $list_data .= '<td class="text-center font-weight-bold">' . $value . '</td>';
        }
        $list_data .= '</tr>';
        return $list_data;
    }

    public function tampilData2($matrik_normalisasi, $prioritas)
    {
        $kriteria = Kriteria::find()->all();
        $list_data2 = '<tr><td></td>';
        foreach ($kriteria as $row) {
            $list_data2 .= '<td class="text-center">' . $row->kode_kriteria . '</td>';
        }
        $list_data2 .= '<td class="text-center font-weight-bold">Jumlah</td>';
        $list_data2 .= '<td class="text-center font-weight-bold">Prioritas</td>';
        $list_data2 .= '</tr>';
        foreach ($kriteria as $i => $row) {
            $list_data2 .= '<tr><td>' . $row->kode_kriteria . '</td>';
            $jumlah = 0;
            foreach ($kriteria as $j => $row2) {
                $jumlah += $matrik_normalisasi[$i][$j];
                $list_data2 .= '<td class="text-center">' . $matrik_normalisasi[$i][$j] . '</td>';
            }
            $list_data2 .= '<td class="text-center font-weight-bold">' . $jumlah . '</td>';
            $list_data2 .= '<td class="text-center font-weight-bold">' . $prioritas[$i] . '</td>';
            $list_data2 .= '</tr>';
        }
        return $list_data2;
    }

    public function tampilData3($matrik_baris, $jumlah_matrik_baris)
    {
        $kriteria = Kriteria::find()->all();
        $list_data3 = '<tr><td></td>';
        foreach ($kriteria as $row) {
            $list_data3 .= '<td class="text-center">' . $row->kode_kriteria . '</td>';
        }
        $list_data3 .= '<td class="text-center font-weight-bold">Jumlah</td>';
        $list_data3 .= '</tr>';
        foreach ($kriteria as $i => $row) {
            $list_data3 .= '<tr><td>' . $row->kode_kriteria . '</td>';
            foreach ($kriteria as $j => $row2) {
                $list_data3 .= '<td class="text-center">' . $matrik_baris[$i][$j] . '</td>';
            }
            $list_data3 .= '<td class="text-center font-weight-bold">' . $jumlah_matrik_baris[$i] . '</td>';
            $list_data3 .= '</tr>';
        }
        return $list_data3;
    }

    public function tampilData4($jumlah_matrik_baris, $prioritas, $tabel_konsistensi)
    {
        $kriteria = Kriteria::find()->all();
        $list_data4 = '<tr><td></td>';
        $list_data4 .= '<td class="text-center">Jumlah per Baris</td>';
        $list_data4 .= '<td class="text-center">Prioritas</td>';
        $list_data4 .= '<td class="text-center font-weight-bold">Hasil</td>';
        $list_data4 .= '</tr>';
        foreach ($kriteria as $i => $row) {
            $list_data4 .= '<tr><td>' . $row->kode_kriteria . '</td>';
            $list_data4 .= '<td class="text-center">' . $jumlah_matrik_baris[$i] . '</td>';
            $list_data4 .= '<td class="text-center">' . $prioritas[$i] . '</td>';
            $list_data4 .= '<td class="text-center font-weight-bold">' . $tabel_konsistensi[$i] . '</td>';
            $list_data4 .= '</tr>';
        }
        return $list_data4;
    }
}
