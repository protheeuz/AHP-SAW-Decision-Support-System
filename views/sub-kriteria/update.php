<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Update Data Sub Kriteria';
$this->params['breadcrumbs'][] = ['label' => 'Data Sub Kriteria', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="sub-kriteria-update">

    <div class="sub-kriteria-form">

        <?= $this->render('_form', [
            'model' => $model,
            'total_sub_kriteria' => $total_sub_kriteria,
            'total_bobot_kriteria' => $total_bobot_kriteria,
        ]) ?>

    </div>
</div>