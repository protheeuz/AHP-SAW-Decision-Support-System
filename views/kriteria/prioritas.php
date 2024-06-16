<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Prioritas Kriteria';
$this->params['breadcrumbs'][] = ['label' => 'Data Kriteria', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="kriteria-prioritas">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Yii::$app->session->getFlash('success'); ?> 

    <div class="alert alert-info">
        Silahkan isi terlebih dahulu nilai kriteria menggunakan perbandingan berpasangan berdasarkan skala perbandingan 1-9 (sesuai teori) kemudian klik <b>SIMPAN</b>. Setelah itu klik <b>CEK KONSISTENSI</b> untuk melakukan pembobotan preferensi dengan menggunakan metode AHP.
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-table"></i> Perbandingan Data Antar Kriteria</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-right" width="25%">Nama Kriteria</th>
                            <th class="text-center" width="50%">Skala Perbandingan</th>
                            <th class="text-left" width="25%">Nama Kriteria</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Logika untuk menampilkan perbandingan data antar kriteria -->
                        <tr>
                            <td class="text-right">Nama Kriteria 1</td>
                            <td class="text-center">
                                <!-- Logika untuk menampilkan skala perbandingan -->
                            </td>
                            <td class="text-left">Nama Kriteria 2</td>
                        </tr>
                        <!-- End Logika -->
                        <tr>
                            <td class="text-center" colspan="3">
                                <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary', 'name' => 'save']) ?>
                                <?= Html::submitButton('Cek Konsistensi', ['class' => 'btn btn-warning', 'name' => 'check']) ?>
                                <?= Html::a('Reset', ['reset'], ['class' => 'btn btn-danger']) ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>    
    </div>

    <?php ActiveForm::end(); ?>
</div>

<!-- Logika untuk menampilkan hasil perhitungan jika cek konsistensi dilakukan -->