<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContractAmountReduceDueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Awaiting for repayments');
?>
<div class="row">
    <div class="col-md-8">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-bank"></i><strong> AWAITING FOR REPAYMENTS</strong></h3>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


                <?= Html::Button(Yii::t('app', '<i class="fa fa-paper-plane"></i> Send SMS'), [
                    'class' => 'btn btn-warning',
                    'value'=> 'Get Student',
                    'id'=>'send-sms',
                    'name' => 'submit',
                ]) ?>

                <?= Html::Button(Yii::t('app', '<i class="fa fa-envelope"></i> Send Email'), [
                    'class' => 'btn btn-warning',
                    'value'=> 'Get Student',
                    'id'=>'customer-id',
                    'name' => 'submit',
                ]) ?>
            </div>
        </div>
    </div>
</div>
<hr>

<?php
$searchModel = new \backend\models\ContractAmountReduceDueSearch();
$dataProvider = $searchModel->searchAwaiting();
?>
<div class="row">
    <div class="col-md-12">
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'contract_ref_number',
            'due_date',
            'monthly_payment',
            'interest_amount_due',
            'principal_amount_due',


        ],
    ]); ?>
    </div>
</div>
