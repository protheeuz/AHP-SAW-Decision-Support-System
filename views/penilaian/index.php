<?php

use yii\helpers\Html;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
use app\models\Penilaian;

$this->title = 'Data Penilaian';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="penilaian-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Yii::$app->session->getFlash('success'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Daftar Data Penilaian</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr align="center">
                            <th width="5%">No</th>
                            <th>Alternatif</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($alternatif as $keys) : ?>
                            <tr align="center">
                                <td><?= $no ?></td>
                                <td align="left"><?= $keys->nama ?></td>
                                <td>
                                    <?php
                                    $cek_tombol = Penilaian::find()->where(['id_alternatif' => $keys->id_alternatif])->count();
                                    if ($cek_tombol == 0) {
                                        echo Html::button('<i class="fa fa-plus"></i> Input', [
                                            'value' => Url::to(['penilaian/create', 'id' => $keys->id_alternatif]),
                                            'class' => 'btn btn-success btn-sm modalButton',
                                        ]);
                                    } else {
                                        echo Html::a('<i class="fa fa-eye"></i> View', ['view', 'id' => $keys->id_alternatif], [
                                            'class' => 'btn btn-info btn-sm',
                                        ]);
                                        echo Html::button('<i class="fa fa-edit"></i> Edit', [
                                            'value' => Url::to(['penilaian/update', 'id' => $keys->id_alternatif]),
                                            'class' => 'btn btn-warning btn-sm modalButton',
                                        ]);
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php $no++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
Modal::begin([
    'title' => '<h4>Input/Edit Penilaian</h4>',
    'id' => 'modal',
    'size' => 'modal-lg',
]);

echo '<div id="modalContent"></div>';

Modal::end();
?>

<?php
$script = <<< JS
$(function () {
    $('.modalButton').click(function () {
        $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
    });
});
JS;
$this->registerJs($script);
?>
