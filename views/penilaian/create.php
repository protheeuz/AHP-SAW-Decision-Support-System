<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="penilaian-form">

    <?php $form = ActiveForm::begin(['id' => 'penilaian-form']); ?>

    <?= Html::hiddenInput('id_alternatif', $id_alternatif) ?>
    
    <?php foreach ($kriteria as $kriteriaItem): ?>
        <div class="form-group">
            <label for="nilai"><?= Html::encode($kriteriaItem->keterangan) ?> (<?= Html::encode($kriteriaItem->kode_kriteria) ?>)</label>
            <?= Html::input('number', 'Penilaian[' . $kriteriaItem->id_kriteria . ']', '', ['class' => 'form-control', 'min' => 1, 'max' => 20, 'required' => true]) ?>
        </div>
    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
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
                $.pjax.reload({container: '#penilaian-container'});
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
$this->registerJs($script);
?>