<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\SubKriteria;

$this->title = 'Data Sub Kriteria';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="sub-kriteria-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Yii::$app->session->getFlash('success'); ?>

    <?php if (empty($kriteria)): ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Daftar Data Sub Kriteria</h6>
        </div>
        <div class="card-body">
            <div class="alert alert-info">Data masih kosong.</div>
        </div>
    </div>
    <?php endif; ?>

    <?php foreach ($kriteria as $key): ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> <?= $key->keterangan." (".$key->kode_kriteria.")" ?></h6>
                <?= Html::button('<i class="fa fa-plus"></i> Tambah Data', ['value' => Url::to(['sub-kriteria/create', 'id' => $key->id_kriteria]), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr align="center">
                            <th width="5%">No</th>
                            <th>Nama Sub Kriteria</th>
                            <th>Nilai</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sub_kriteria1 = SubKriteria::find()->where(['id_kriteria' => $key->id_kriteria])->all();
                        $no=1;
                        foreach ($sub_kriteria1 as $sub): ?>
                        <tr align="center">
                            <td><?= $no ?></td>
                            <td align="left"><?= $sub->deskripsi ?></td>
                            <td><?= $sub->nilai ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <?= Html::a('<i class="fa fa-edit"></i>', ['update', 'id' => $sub->id_sub_kriteria], ['class' => 'btn btn-warning btn-sm']) ?>
                                    <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $sub->id_sub_kriteria], [
                                        'class' => 'btn btn-danger btn-sm',
                                        'data' => [
                                            'confirm' => 'Apakah anda yakin untuk menghapus data ini?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </div>
                            </td>
                        </tr>
                        <?php $no++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>