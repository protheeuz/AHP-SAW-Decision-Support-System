<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Detail Penilaian: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Data Penilaian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="penilaian-view">

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
        ],
    ]) ?>

    <h3>Detail Penilaian</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kriteria</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kriteria as $kriteriaItem): ?>
                <tr>
                    <td><?= Html::encode($kriteriaItem->keterangan) ?> (<?= Html::encode($kriteriaItem->kode_kriteria) ?>)</td>
                    <td>
                        <?php
                        $nilai = '';
                        foreach ($penilaian as $pen) {
                            if ($pen->id_kriteria == $kriteriaItem->id_kriteria) {
                                $nilai = $pen->nilai;
                            }
                        }
                        echo Html::encode($nilai);
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>