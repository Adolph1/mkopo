<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AccdailyBalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Accounts balances');
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3  style="color: #003b4c;font-family: Tahoma"><i class="fa fa-line-chart"></i><strong> ACCOUNTS BALANCES REPORT</strong></h3>
    </div>

</div>
<hr/>
<div class="accdaily-bal-index">
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'account',
           [
                   'attribute'=>'available_balance',
                   'value'=>function ($model){
                            $account=\backend\models\AccdailyBal::getBalance($model->account);
                        return  $account->available_balance;
                   }
           ],
            [
                'header'=>'Customer Name',
                'value'=>function ($model){
                    $accountowner=\backend\models\Account::getAccountOwner($model->account);
                    return $accountowner;
                }
            ],

        ],
        'clientOptions' => [
            "lengthMenu"=> [[20,-1], [20,Yii::t('app',"All")]],
            "info"=>true,
            "responsive"=>true,
            "dom"=> 'lfTrtip',
            "tableTools"=>[
                "aButtons"=> [
                    [
                        "sExtends"=> "copy",
                        "sButtonText"=> Yii::t('app',"Copy to clipboard")
                    ],[
                        "sExtends"=> "csv",
                        "sButtonText"=> Yii::t('app',"Save to CSV")
                    ],
                    [
                        "sExtends"=> "xls",
                        "oSelectorOpts"=> ["page"=> 'current']
                    ],[
                        "sExtends"=> "pdf",
                        "sButtonText"=> Yii::t('app',"Save to PDF")
                    ],[
                        "sExtends"=> "print",
                        "sButtonText"=> Yii::t('app',"Print")
                    ],
                ]
            ]
        ],
    ]); ?>
</div>
