<?php

use yii\helpers\Html;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
use app\models\Penilaian;

$this->title = 'Data Penilaian';
$this->params['breadcrumbs'][] = $this->title;

$years = range(date('Y'), 2022); // Menyediakan pilihan tahun dari 2020 hingga sekarang
$currentYear = $tahun;

?>

<div class="penilaian-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Yii::$app->session->getFlash('success'); ?>

    <div class="form-group">
        <?= Html::dropDownList('tahun', $currentYear, array_combine($years, $years), [
            'class' => 'form-control',
            'onchange' => 'window.location.href = "' . Url::to(['penilaian/index']) . '?tahun=" + $(this).val();',
        ]) ?>
    </div>

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
                            <th>Nama Karyawan</th>
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
                                    $cek_tombol = Penilaian::find()->where(['id_alternatif' => $keys->id_alternatif, 'tahun' => $currentYear])->count();
                                    if (Yii::$app->user->identity->id_user_level != 3) { // Hanya tampilkan tombol untuk selain Karyawan
                                        if ($cek_tombol == 0) {
                                            echo Html::button('<i class="fa fa-plus"></i> Input', [
                                                'value' => Url::to(['penilaian/create', 'id' => $keys->id_alternatif, 'tahun' => $currentYear]),
                                                'class' => 'btn btn-success btn-sm modalButton',
                                            ]);
                                        } else {
                                            echo Html::button('<i class="fa fa-edit"></i> Edit', [
                                                'value' => Url::to(['penilaian/update', 'id' => $keys->id_alternatif, 'tahun' => $currentYear]),
                                                'class' => 'btn btn-warning btn-sm modalButton',
                                            ]);
                                        }
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

    $(document).on('beforeSubmit', '#penilaian-form', function (e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function (response) {
                console.log(response); // Tambahkan log ini untuk melihat respon dari server
                if (response.success) {
                    $('#modal').modal('hide');
                    location.reload(); // Reload halaman untuk memperbarui data
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert('Terjadi kesalahan saat menyimpan data.');
            }
        });
        return false;
    });
});
JS;
$this->registerJs($script);
?>