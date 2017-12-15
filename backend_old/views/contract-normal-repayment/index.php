<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContractNormalRepaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contract Repayments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-normal-repayment-index">

    <h1><?php //Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a('Create Contract Normal Repayment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="row">
        <div class="col-md-2 pull-right">
            <?php
            echo ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' =>
                    [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'contract_ref_number',
                        [
                            'attribute'=>'due_date',
                            'pageSummary'=>'Total',
                            'vAlign'=>'middle',
                            'width'=>'210px',

                        ],
                        [
                            'attribute'=>'contract_amount',
                            'hAlign'=>'right',
                            'vAlign'=>'middle',
                            'width'=>'7%',
                            //'format'=>['decimal', 2],
                            'pageSummary'=>true
                        ],
                        [
                            'attribute'=>'interest',
                            'hAlign'=>'right',
                            'vAlign'=>'middle',
                            'width'=>'7%',
                            //'format'=>['decimal', 2],
                            'pageSummary'=>true
                        ],
                        [
                            'attribute'=>'contract_outstanding',
                            'hAlign'=>'right',
                            'vAlign'=>'middle',
                            'width'=>'7%',
                            //'format'=>['decimal', 2],
                            'pageSummary'=>true
                        ],
                        [
                            'attribute'=>'customer_installment',
                            'hAlign'=>'right',
                            'vAlign'=>'middle',
                            'width'=>'7%',
                            //'format'=>['decimal', 2],
                            'pageSummary'=>true
                        ],
                        [
                            'attribute'=>'balance',
                            'hAlign'=>'right',
                            'vAlign'=>'middle',
                            'width'=>'7%',
                            //'format'=>['decimal', 2],
                            'pageSummary'=>true
                        ],
                        'month_factor',
                        [
                            'attribute'=>'expected_installment',
                            'hAlign'=>'right',
                            'vAlign'=>'middle',
                            'width'=>'7%',
                            //'format'=>['decimal', 2],
                            'pageSummary'=>true
                        ],

                        'pre_liquidation',
                        //'pre_liquidation',
                        'pre_liquidation_rate',
                        'maker_id',
                        'maker_time',
                        'status',
                        ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],


                    ],
                //'class'=>'\kartik\grid\DataColumn',
                // 'pageSummary'=>'Total',
                'fontAwesome' => true,

                'showPageSummary' => true,
                'dropdownOptions' => [
                    'label' => 'Export All',
                    'class' => 'btn btn-success'
                ]
            ]);


            ?>
        </div>
    </div>
    <?php
    $gridColumns = [
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'attribute'=>'due_date',
            'pageSummary'=>'Total',
            'vAlign'=>'middle',
            'width'=>'210px',

        ],
        [
            'attribute'=>'contract_amount',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'7%',
            //'format'=>['decimal', 2],
            'pageSummary'=>true
        ],
        [
            'attribute'=>'interest',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'7%',
            //'format'=>['decimal', 2],
            'pageSummary'=>true
        ],
        [
            'attribute'=>'contract_outstanding',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'7%',
            //'format'=>['decimal', 2],
            'pageSummary'=>true
        ],
        [
            'attribute'=>'customer_installment',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'7%',
            //'format'=>['decimal', 2],
            'pageSummary'=>true
        ],
        [
            'attribute'=>'balance',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'7%',
            //'format'=>['decimal', 2],
            'pageSummary'=>true
        ],
        'month_factor',
        [
            'attribute'=>'expected_installment',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'7%',
            //'format'=>['decimal', 2],
            'pageSummary'=>true
        ],

        'pre_liquidation',
        //'pre_liquidation',
        'pre_liquidation_rate',
        'maker_id',
        'maker_time',
        'status',

    ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'showPageSummary'=>true,
    ]); ?>

</div>
