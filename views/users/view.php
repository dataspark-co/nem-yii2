<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-6">
            <?= Html::a('Clear user private key', ['clear-private-key', 'id' => $model->id], [
                'class' => 'btn btn-warning btn-block',
                'data' => [
                    'confirm' => 'Are you sure you want to clear user private key?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-block',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>

    <hr>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'user_public_key',
            [
                'attribute' => 'user_private_key',
                'value' => function($model){
                    return $model->privateKayValue;
                }
            ],
            [
                'attribute' => 'user_address',
                'value' => function($model){
                    return $model->formattedAddress;
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
