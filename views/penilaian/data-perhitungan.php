<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Data Perhitungan';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="penilaian-data-perhitungan">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Data Perhitungan</h6>
        </div>

        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'id_alternatif',
                        'value' => 'alternatif.nama', // Menggunakan relasi untuk menampilkan nama alternatif
                    ],
                    [
                        'attribute' => 'id_kriteria',
                        'value' => 'kriteria.keterangan', // Menggunakan relasi untuk menampilkan keterangan kriteria
                    ],
                    'nilai',
                ],
                'pager' => [
                    'options' => ['class' => 'pagination'],
                    'prevPageLabel' => '&laquo;',
                    'nextPageLabel' => '&raquo;',
                    'maxButtonCount' => 5,
                ],
            ]); ?>
        </div>
    </div>
</div>

<?php
$this->registerCss("
    .pagination {
        display: flex;
        justify-content: center;
        padding-left: 0;
        list-style: none;
        border-radius: 0.25rem;
    }

    .pagination li {
        display: inline;
    }

    .pagination li a {
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #007bff;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }

    .pagination li a:focus,
    .pagination li a:hover {
        z-index: 2;
        color: #0056b3;
        text-decoration: none;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .pagination li:first-child a {
        margin-left: 0;
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
    }

    .pagination li:last-child a {
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
    }
");
?>