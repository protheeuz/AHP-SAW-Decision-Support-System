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
    <?= Yii::$app->session->getFlash('error'); ?> 

    <div class="alert alert-info">
        Silahkan isi terlebih dahulu nilai kriteria menggunakan perbandingan berpasangan berdasarkan skala perbandingan 1-9, di mana 1 menunjukkan tidak penting dan 9 menunjukkan sangat penting, kemudian klik <b>SIMPAN</b>. Setelah itu klik <b>CEK KONSISTENSI</b> untuk melakukan pembobotan preferensi dengan menggunakan metode AHP.
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
                        <?php foreach ($kriteria as $i => $kriteria1): ?>
                            <?php foreach ($kriteria as $j => $kriteria2): ?>
                                <?php if ($i < $j): ?>
                                    <tr>
                                        <td class="text-right"><?= Html::encode($kriteria1->keterangan) ?></td>
                                        <td class="text-center">
                                            <?= Html::dropDownList("comparison[$kriteria1->id_kriteria][$kriteria2->id_kriteria]", null, [
                                                1 => '1 - Tidak penting',
                                                2 => '2 - Sedikit lebih penting',
                                                3 => '3 - Sedikit penting',
                                                4 => '4 - Cukup penting',
                                                5 => '5 - Penting',
                                                6 => '6 - Lebih penting',
                                                7 => '7 - Sangat penting',
                                                8 => '8 - Hampir paling penting',
                                                9 => '9 - Paling penting',
                                            ], ['class' => 'form-control', 'prompt' => 'Pilih Skala']) ?>
                                        </td>
                                        <td class="text-left"><?= Html::encode($kriteria2->keterangan) ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
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
<?php if (isset($tabelKonsistensi)): ?>
    <div class="alert alert-success">
        <h4>Hasil Konsistensi</h4>
        <p>Consistency Index (CI): <?= $tabelKonsistensi['ci'] ?></p>
        <p>Consistency Ratio (CR): <?= $tabelKonsistensi['cr'] ?></p>
        <p>
            Status Konsistensi:
            <?php if ($isConsistent): ?>
                <span class="text-success">Konsisten</span>
            <?php else: ?>
                <span class="text-danger">Tidak Konsisten</span>
            <?php endif; ?>
        </p>
    </div>
<?php endif; ?>