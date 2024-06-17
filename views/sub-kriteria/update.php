<?php

use yii\helpers\Html;

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
