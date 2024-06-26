<?php

use yii\helpers\Html;

$this->title = 'Tambah Data Sub Kriteria';
$this->params['breadcrumbs'][] = ['label' => 'Data Sub Kriteria', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="sub-kriteria-create">

    <div class="sub-kriteria-form">

        <?= $this->render('_form', [
            'model' => $model,
            'total_sub_kriteria' => $total_sub_kriteria,
            'total_bobot_kriteria' => $total_bobot_kriteria,
        ]) ?>

    </div>
</div>