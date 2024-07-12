<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Edit Penilaian';
$this->params['breadcrumbs'][] = ['label' => 'Data Penilaian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="penilaian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Yii::$app->session->getFlash('success'); ?>

    <div class="penilaian-form">

        <?php $form = ActiveForm::begin(['id' => 'penilaian-form']); ?>

        <?= Html::hiddenInput('id_alternatif', $id_alternatif) ?>
        
        <?php foreach ($kriteria as $kriteriaItem): ?>
            <div class="form-group">
                <label for="nilai"><?= Html::encode($kriteriaItem->keterangan) ?> (<?= Html::encode($kriteriaItem->kode_kriteria) ?>)</label>
                <?php
                $nilai = '';
                foreach ($penilaian as $pen) {
                    if ($pen->id_kriteria == $kriteriaItem->id_kriteria) {
                        $nilai = $pen->nilai;
                    }
                }
                ?>
                <?= Html::input('number', 'Penilaian[' . $kriteriaItem->id_kriteria . ']', $nilai, ['class' => 'form-control', 'min' => 1, 'max' => 20, 'required' => true]) ?>
            </div>
        <?php endforeach; ?>

        <div class="form-group">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

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
                $.pjax.reload({container: '#dataTable'});
                alert(response.message);
            } else {
                alert(response.message);
            }
        }
    });
    return false;
});
JS;
$this->registerJs($script);
?>