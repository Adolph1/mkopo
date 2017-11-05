<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BankTransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Bank Transactions');
?>

<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-money text-yellow"></i><strong> STUDENTS BANK TRANSACTIONS </strong></h3>
    </div>

</div>
<hr>
<div class="bank-transaction-index">

    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'trn_dt',
            'amount',
            //'description',
            'source_ref_no',
            'student_reg_no',
            [
                'attribute'=>'payment_type_id',
                'value'=>'type.title'
            ],
            'bank_name',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>
</div>
