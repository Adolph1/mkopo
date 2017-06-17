<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SystemCharges */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'System Charges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-charges-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'charge_name',
            'description',
            'charge',
            'status',
            'maker_id',
            'maker_time',
        ],
    ]) ?>

</div>
