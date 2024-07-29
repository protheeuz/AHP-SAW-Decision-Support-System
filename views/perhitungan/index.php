<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

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
                        'label' => 'Nama Karyawan',
                        'value' => function ($model) {
                            Yii::info('Data Alternatif: ' . json_encode($model->alternatif), __METHOD__);
                            return $model->alternatif ? $model->alternatif->nama : 'N/A'; // Menggunakan relasi untuk menampilkan nama alternatif
                        },
                    ],
                    [
                        'attribute' => 'id_kriteria',
                        'label' => 'Kriteria',
                        'value' => function ($model) {
                            Yii::info('Data Kriteria: ' . json_encode($model->kriteria), __METHOD__);
                            return $model->kriteria ? $model->kriteria->keterangan : 'N/A'; // Menggunakan relasi untuk menampilkan keterangan kriteria
                        },
                    ],
                    'nilai',
                ],
                'pager' => [
                    'class' => LinkPager::class,
                    'pagination' => $dataProvider->pagination,
                    'maxButtonCount' => 5,
                    'linkOptions' => ['class' => 'page-link'],
                    'disabledPageCssClass' => 'disabled',
                    'prevPageLabel' => false, // Menyembunyikan simbol "«"
                    'nextPageLabel' => false,
                    'firstPageLabel' => false,
                    'lastPageLabel' => false,
                    'options' => ['class' => 'pagination justify-content-center'],
                    'pageCssClass' => 'page-item',
                    'activePageCssClass' => 'active',
                ],
            ]); ?>
        </div>
    </div>
</div>

<!-- Gaya CSS kustom -->
<?php
$css = <<<CSS
.pagination {
    margin: 0;
    padding: 0;
    list-style: none;
}

.page-item {
    display: inline;
}

.page-link {
    color: #007bff;
    padding: 0.5rem 0.75rem;
    margin-left: -1px;
    position: relative;
    display: block;
    line-height: 1.25;
    background-color: #fff;
    border: 1px solid #dee2e6;
    text-decoration: none;
}

.page-link:hover {
    color: #0056b3;
    background-color: #e9ecef;
    border-color: #dee2e6;
}

.page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}
CSS;
$this->registerCss($css);
?>