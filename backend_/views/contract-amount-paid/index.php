<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContractAmountPaidSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contract Amount Paids';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-amount-paid-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Contract Amount Paid', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'contract_ref_no',
            'component',
            'due_date',
            'paid_date',
            // 'currency_settled',
            // 'account_settled',
            // 'customer_number',
            // 'amount_settled',
            // 'inflow_outflow',
            // 'base_amount',
            // 'amount_prepaid',
            // 'payment_status',
            // 'accounting_passed',
            // 'message_sent',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
