<?php

use yii\helpers\Html;
use yii\bootstrap4\BootstrapAsset;
use yii\web\YiiAsset;

BootstrapAsset::register($this);
YiiAsset::register($this);

/* @var $this \yii\web\View */
/* @var $content string */
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?= $this->render('header') ?>
        <div class="container">
            <?= $content ?>
        </div>
    </div>

    <?= $this->render('footer') ?>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>