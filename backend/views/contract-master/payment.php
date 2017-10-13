<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\ContractMaster */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-file-o"></i><strong> LOAN PAYMENTS</strong></h3>
    </div>

</div>
<div class="row">
    <div class="col-md-11"></div>
    <div class="col-md-1 text-right">
        <?= Html::a(Yii::t('app', '<i class="fa fa-reply"></i> '), ['view','id'=>$model->contract_ref_no], ['class' => 'btn btn-default','data-toggle'=>'tooltip','data-original-title'=>'Back']) ?>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="btn-group btn-group-justified">

            <?= Html::a(Yii::t('app', '<i class="fa fa-file-o"></i> NEW LOAN'), ['create'], ['class' => 'btn btn-primary']) ?>


            <?= Html::a(Yii::t('app', '<i class="fa fa-th text-black"></i> LOANS CONTRACTS LIST'), ['index'], ['class' => 'btn btn-primary ']) ?>

        </div>
    </div>
</div>
<hr>

<?php
$searchModel = new \backend\models\PaymentSearch();
$dataProvider = $searchModel->searchByReference($model->contract_ref_no);
?>
<div class="row">
    <div class="col-md-12">
        <?php
        $gridColumns=[
            ['class' => 'kartik\grid\SerialColumn'],
            'trn_dt',
            [

                'attribute'=>'component',
                'pageSummary'=>'Total',
                'vAlign'=>'middle',

            ],
            [
                'attribute'=>'amount_paid',
                'format'=>['decimal', 2],
                'pageSummary'=>true,
            ],
            [
                'attribute'=>'due_date',
                //'format'=>['decimal', 2],
                //'pageSummary'=>true,
            ],
            [
                'attribute'=>'related_customer',
                'value'=>function($model){
                    return \backend\models\Customer::getFullNameByCustomerNumber($model->related_customer);
                }

            ],

            [
                'class'=>'kartik\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{reverse}',
                'buttons'=>[
                    'reverse' => function ($url, $model) {
                            $url = ['payment/reverse', 'id' => $model->id];
                            return Html::a('<span class="fa fa-retweet"></span> Reverse', $url, [
                                'title' => 'Reverse',
                                'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                                'class' => 'btn btn-warning',

                            ]);


                    },

                ]
            ],
            ]
        ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'panel' => [
                //'heading'=>'Repayment Schedule',
               // 'type'=>'default',
                //'before'=>'  - ',
                'after'=>''
            ],

            'toolbar' => [

                '{export}',
                // '{toggleData}'
            ],
            'export'=>[
                'fontAwesome'=>true,
                'options'       => [
                    'title'    => 'Loan Payments',
                    'subject'  => 'PDF export',
                    'keywords' => 'pdf'
                ],
            ],

            // 'pjax'=>true,
            'showHeader' => true,
            'columns' =>$gridColumns,



            'showPageSummary'=>true,
            'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
            'headerRowOptions'=>['class'=>'kartik-sheet-style'],
            'filterRowOptions'=>['class'=>'kartik-sheet-style'],





        ]);


        ?>
    </div>
</div>
