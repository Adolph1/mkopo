<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SystemRates */

$this->title = $model->rate_name;
$this->params['breadcrumbs'][] = ['label' => 'System Rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-rates-view">

    <h1><?php // Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /* Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'rate_name',
            'status',
            'maker_id',
            'maker_time',
        ],
    ]) ?>

</div>
