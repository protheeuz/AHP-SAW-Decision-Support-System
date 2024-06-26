<?php

use yii\helpers\Html;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
use app\models\SubKriteria;

$this->title = 'Data Sub Kriteria';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="sub-kriteria-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Yii::$app->session->getFlash('success'); ?>
    <?= Yii::$app->session->getFlash('error'); ?>

    <?php if (empty($kriteria)) : ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Daftar Data Sub Kriteria</h6>
            </div>
            <div class="card-body">
                <div class="alert alert-info">Data masih kosong.</div>
            </div>
        </div>
    <?php endif; ?>

    <?php foreach ($kriteria as $key) : ?>
        <?php
        $sub_kriteria1 = $key->subKriterias;
        $total_sub_kriteria = array_sum(array_map(function ($sub) {
            return $sub->nilai;
        }, $sub_kriteria1));
        $remaining_weight = $key->bobot - $total_sub_kriteria;
        ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> <?= $key->keterangan . " (" . $key->kode_kriteria . ")" ?></h6>
                    <?php if ($remaining_weight > 0) : ?>
                        <?= Html::button('<i class="fa fa-plus"></i> Tambah Data', ['value' => Url::to(['sub-kriteria/create', 'id' => $key->id_kriteria]), 'class' => 'btn btn-success modalButton', 'data-toggle' => 'modal', 'data-target' => '#modal' . $key->id_kriteria]) ?>
                    <?php else : ?>
                        <?= Html::button('<i class="fa fa-plus"></i> Tambah Data', ['class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#warningModal' . $key->id_kriteria]) ?>
                    <?php endif; ?>
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
                            $no = 1;
                            foreach ($sub_kriteria1 as $sub) : ?>
                                <tr align="center">
                                    <td><?= $no ?></td>
                                    <td align="left"><?= $sub->nama_sub_kriteria ?></td>
                                    <td><?= $sub->nilai ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <?= Html::button('<i class="fa fa-edit"></i> Edit', ['value' => Url::to(['sub-kriteria/update', 'id' => $sub->id_sub_kriteria]), 'class' => 'btn btn-warning btn-sm modalButton', 'data-toggle' => 'modal', 'data-target' => '#editModal' . $sub->id_sub_kriteria]) ?>
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
                            <?php $no++;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php
        Modal::begin([
            'id' => 'warningModal' . $key->id_kriteria,
            'title' => '<h4>Warning</h4>',
            'size' => 'modal-md',
        ]);

        echo "<div class='alert alert-danger'>Total nilai sub-kriteria tidak bisa melebihi nilai total bobot kriteria.</div>";

        Modal::end();

        Modal::begin([
            'id' => 'modal' . $key->id_kriteria,
            'size' => 'modal-lg',
            'title' => '<h4>Tambah Data Sub Kriteria</h4>',
        ]);

        echo "<div id='modalContent" . $key->id_kriteria . "'></div>";

        Modal::end();
        ?>
    <?php endforeach; ?>
</div>

<?php
Modal::begin([
    'id' => 'warningModalGlobal',
    'title' => '<h4>Warning</h4>',
    'size' => 'modal-md',
]);

echo "<div class='alert alert-danger'>Total nilai sub-kriteria tidak bisa melebihi nilai total bobot kriteria.</div>";

Modal::end();

$script = <<< JS
$(function() {
    $('.modalButton').click(function() {
        var modal = $(this).data('target');
        $(modal).modal('show')
            .find('#modalContent' + modal.replace('#modal', ''))
            .load($(this).attr('value'));
    });

    $('#subkriteria-form').on('beforeSubmit', function(e) {
        var form = $(this);
        var nilaiSubKriteria = parseFloat($('#subkriteria-nilai').val());
        var totalSubKriteria = parseFloat($('#total-sub-kriteria').val());
        var totalBobotKriteria = parseFloat($('#total-bobot-kriteria').val());

        if (totalSubKriteria + nilaiSubKriteria > totalBobotKriteria) {
            $('#warningModalGlobal').modal('show');
            return false; // prevent form submission
        }

        return true;
    });
});
JS;
$this->registerJs($script);
?>