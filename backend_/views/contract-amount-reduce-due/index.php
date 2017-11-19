<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContractAmountReduceDueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Contract Amount Reduce Dues');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-amount-reduce-due-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Contract Amount Reduce Due'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'contract_ref_number',
            'due_date',
            'monthly_payment',
            'interest_amount_due',
            // 'principal_amount_due',
            // 'balance',
            // 'interest_amount_settled',
            // 'principal_amount_settled',
            // 'account_due',
            // 'customer_number',
            // 'inflow_outflow',
            // 'basis_amount_tag',
            // 'adjusted_amount',
            // 'scheduled_linkage',
            // 'amount_prepaid',
            // 'original_due_date',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
