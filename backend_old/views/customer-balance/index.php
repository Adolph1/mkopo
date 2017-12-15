<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomerBalanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Customer Balances');
?>

<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-building"></i><strong> CUSTOMERS BALANCES</strong></h3>
    </div>

</div>
<hr/>
<div class="row">
    <div class="col-md-12">
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'header'=>'Customer Name',
                'value'=>function($model){
                    return \backend\models\Customer::getFullNameByCustomerNumber($model->customer_number);
                }
            ],
            'customer_number',
            'opening_balance',
            'current_balance',
            'last_updated',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
</div>
