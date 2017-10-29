<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ContractAmountReduceDue */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contract Amount Reduce Dues'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-amount-reduce-due-view">

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
            'contract_ref_number',
            'due_date',
            'monthly_payment',
            'interest_amount_due',
            'principal_amount_due',
            'balance',
            'interest_amount_settled',
            'principal_amount_settled',
            'account_due',
            'customer_number',
            'inflow_outflow',
            'basis_amount_tag',
            'adjusted_amount',
            'scheduled_linkage',
            'amount_prepaid',
            'original_due_date',
            'status',
        ],
    ]) ?>

</div>
