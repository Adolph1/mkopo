<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ContractAmountPaid */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contract Amount Paids', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-amount-paid-view">

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
            'contract_ref_no',
            'component',
            'due_date',
            'paid_date',
            'currency_settled',
            'account_settled',
            'customer_number',
            'amount_settled',
            'inflow_outflow',
            'base_amount',
            'amount_prepaid',
            'payment_status',
            'accounting_passed',
            'message_sent',
        ],
    ]) ?>

</div>
