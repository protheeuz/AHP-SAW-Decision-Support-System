<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\SubKriteria;
use app\models\Kriteria;
use yii\web\View;

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

</div>