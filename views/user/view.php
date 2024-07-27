<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_user], ['class' => 'btn btn-primary']) ?>
        <?php if (Yii::$app->user->identity->id_user_level == 1): ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id_user], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_user',
            'nama',
            'email:email',
            'username',
            //'password', // For security reasons, you might not want to display the password hash
            [
                'attribute' => 'id_user_level',
                'value' => $model->userLevel->user_level,
                'label' => 'User Level'
            ],
        ],
    ]) ?>

</div>