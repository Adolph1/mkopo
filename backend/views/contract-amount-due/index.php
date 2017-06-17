<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use kartik\grid\DataColumn;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContractAmountDueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Loan Repayment Schedule';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-amount-due-index">
    <div class="row">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="row">
        <div class="col-md-2 pull-right">
            <?php
            echo ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' =>
                        [
                            ['class' => 'yii\grid\SerialColumn'],
                            'contract_ref_number',
                            'component',
                            'due_date',
                            'amount_due',
                            'currency_amt_due',
                            'account_due',
                            [
                                'class' => 'kartik\grid\EditableColumn',
                                'attribute' => 'contract_ref_number',
                                'pageSummary' => 'Total',

                                'vAlign'=>'middle',
                                'headerOptions'=>['class'=>'kv-sticky-column'],
                                'contentOptions'=>['class'=>'kv-sticky-column'],
                                'editableOptions'=>['header'=>'Name', 'size'=>'md']
                            ],
                            // 'customer_number',
                            'amount_settled',
                            // 'inflow_outflow',
                            // 'basis_amount_tag',
                            // 'adjusted_amount',
                            // 'scheduled_linkage',
                            // 'component_type',
                            // 'amount_prepaid',
                            // 'original_due_date',

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
    <div class="row">
        <div class="col-md-12">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'contract_ref_number',
                    'component',
                    'due_date',
                    'amount_due',
                    'currency_amt_due',
                    'account_due',

                    // 'customer_number',
                    'amount_settled',
                    // 'inflow_outflow',
                    // 'basis_amount_tag',
                    // 'adjusted_amount',
                    // 'scheduled_linkage',
                    // 'component_type',
                    // 'amount_prepaid',
                    // 'original_due_date',

                    ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
                ],

                //'showPageSummary' => true,


            ]);




            // Renders a export dropdown menu

            // You can choose to render your own GridView separately

            ?>
        </div>
    </div>
</div>
