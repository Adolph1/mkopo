<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Contribution */

$this->title = \backend\models\Customer::getFullNameByCustomerNumber($model->customer_number);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contributions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contribution-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text text-right">
        <?if($model->auth_stat=='U' && Yii::$app->user->can('LoanManager')) echo Html::a(Yii::t('app', 'Approve'), ['approve', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'trn_ref_no',
            'trn_dt',
            'payment_date',
            [
                'attribute'=>'payment_type',
                'value'=>$model->payment->method_name,
            ],
            [
                'attribute'=>'customer_number',
                'value'=>function ($model){

                    return \backend\models\Customer::getFullNameByCustomerNumber($model->customer_number);
                }
            ],
            'amount',
            [
                'attribute'=>'contribution_type',
                'value'=>$model->type->title,
            ],

            'period',
            'financial_year',
            'reference',
            'description',
            'auth_stat',
            'maker_id',
            'maker_time',
            'checker_id',
            'checker_time',
        ],
    ]) ?>

    <p class="text text-right">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
