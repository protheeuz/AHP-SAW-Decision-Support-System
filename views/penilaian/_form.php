<?php

use yii\helpers\Html;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\models\Penilaian;

$this->title = 'Data Penilaian';
$this->params['breadcrumbs'][] = $this->title;

$years = range(date('Y'), 2022);
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
            <?php Pjax::begin(['id' => 'penilaian-pjax-container']); ?>
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
            <?php Pjax::end(); ?>
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
$script = <<<JS
function bindModalButtons() {
    $('.modalButton').click(function () {
        var modal = $('#modal');
        var url = $(this).attr('value');

        $.ajax({
            url: url,
            success: function (response) {
                modal.modal('show')
                    .find('#modalContent')
                    .html(response);
            },
            error: function () {
                alert('Gagal memuat konten modal.');
            }
        });
    });
}

// Bind modal buttons when page is loaded
bindModalButtons();

// Re-bind modal buttons after PJAX is updated
$(document).on('pjax:end', function () {
    bindModalButtons();
});

$(document).on('beforeSubmit', '#penilaian-form', function (e) {
    e.preventDefault();
    var form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: form.serialize(),
        success: function (response) {
            if (response.success) {
                $('#modal').modal('hide');
                $.pjax.reload({container: '#penilaian-pjax-container'});
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
JS;
$this->registerJs($script, \yii\web\View::POS_READY);
?>