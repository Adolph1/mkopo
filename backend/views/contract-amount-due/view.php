<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ContractAmountDue */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contract Amount Dues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-amount-due-view">

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
            'amount_due',
            'currency_amt_due',
            'account_due',
            'customer_number',
            'amount_settled',
            'inflow_outflow',
            'basis_amount_tag',
            'adjusted_amount',
            'scheduled_linkage',
            'component_type',
            'amount_prepaid',
            'original_due_date',
        ],
    ]) ?>

</div>
