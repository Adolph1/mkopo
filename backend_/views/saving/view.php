<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Saving */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Savings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="saving-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'customer_number',
            'trn_date',
            'amount',
            'fc_period',
            'fc_year',
            'description',
            'payment_method',
            'reference',
            'status',
            'maker_id',
            'maker_time',
            'auth_stat',
            'checker_id',
            'checker_time',
            'next_pay_date',
        ],
    ]) ?>

</div>
