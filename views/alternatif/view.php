<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Detail Data Karyawan: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Data Karyawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alternatif-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_alternatif], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_alternatif], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_alternatif',
            'nama',
            'divisi',
        ],
    ]) ?>

</div>