<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model backend\models\ContractMaster */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-12">
        <?php
        if($model->calculation_method==\backend\models\ContractMaster::FLAT_RATE) {
            $searchModel = new \backend\models\ContractAmountDueSearch();
            $dataProvider = $searchModel->searchByReference($model->contract_ref_no);
            $gridColumns = [
                ['class' => 'kartik\grid\SerialColumn'],
                'due_date',
                [

                    'attribute' => 'component',
                    'pageSummary' => 'Total',
                    'vAlign' => 'middle',

                ],
                [
                    'attribute' => 'amount_due',
                    'format' => ['decimal', 2],
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'amount_settled',
                    'format' => ['decimal', 2],
                    'pageSummary' => true,
                ],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'header' => 'Actions',
                    'template' => '{view}',
                    /*'buttons' => [
                        'liquidate' => function ($url, $model) {
                            $contract = \backend\models\ContractMaster::getContract($model->contract_ref_number);
                            if ($model->status == 'A' && strtotime($model->due_date) <= strtotime(date('Y-m-d')) && $contract->auth_stat == 'A' && yii::$app->User->can('LoanOfficer')) {
                                $url = ['contract-amount-due/liquidate', 'id' => $model->id];
                                return Html::a('<span class="fa fa-check"></span> Repay', $url, [
                                    'title' => 'Repay',
                                    'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                                    'class' => 'btn btn-warning',
                                    'data' => [
                                        'confirm' => Yii::t('app', 'Are you sure you want to repay this loan?'),
                                        'method' => 'post',
                                    ],

                                ]);
                            } elseif ($model->status == 'A' && strtotime($model->due_date) >= strtotime(date('Y-m-d')) && $contract->auth_stat == 'A' && yii::$app->User->can('LoanOfficer')) {
                                $url = ['contract-amount-due/pre-liquidate', 'id' => $model->id];
                                return Html::a('<span class="fa fa-check"></span> Pre Repay', $url, [
                                    'title' => 'Pre Repay',
                                    'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                                    'class' => 'btn btn-info',
                                    'data' => [
                                        'confirm' => Yii::t('app', 'Are you sure you want to repay this loan?'),
                                        'method' => 'post',
                                    ],

                                ]);
                            } elseif ($model->status == 'L' && $contract->auth_stat == 'A' && yii::$app->User->can('LoanOfficer')) {
                                $url = ['payment/reverse', 'id' => $model->id];
                                return Html::a('<span class="fa fa-retweet"></span> Reverse', $url, [
                                    'title' => 'Reverse',
                                    'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                                    'class' => 'btn btn-warning',
                                    'data' => [
                                        'confirm' => Yii::t('app', 'Are you sure you want to Repay this loan?'),
                                        'method' => 'post',
                                    ],

                                ]);
                            }

                        },

                    ]*/
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('<span class="fa fa-pencil"></span>','#', [
                                'id' => 'activity-view-link',
                                'title' => Yii::t('yii', 'View'),
                                'data-toggle' => 'modal',
                                'data-target' => '#activity-modal',
                                'data-id' => $key,
                                'data-pjax' => '0',

                            ]);
                        },
                    ],
                ],
            ]
            ?>


            <?= GridView::widget([
                'dataProvider' => $dataProvider,


                'toolbar' => [

                    '{export}',
                    // '{toggleData}'
                ],
                'export' => [
                    'fontAwesome' => true,
                    'options' => [
                        'title' => 'Custom Title',
                        'subject' => 'PDF export',
                        'keywords' => 'pdf'
                    ],
                ],

                // 'pjax'=>true,
                'showHeader' => true,
                'columns' => $gridColumns,


                'showPageSummary' => true,
                'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                'filterRowOptions' => ['class' => 'kartik-sheet-style'],


            ]);

        }
        if($model->calculation_method==\backend\models\ContractMaster::REDUCING_BALANCE){
            Pjax::begin();
            $searchModel = new \backend\models\ContractAmountReduceDueSearch();
            $dataProvider = $searchModel->searchByReference($model->contract_ref_no);
            $gridColumns = [
                ['class' => 'kartik\grid\SerialColumn'],
                [

                    'attribute' => 'due_date',
                    'pageSummary' => 'Total',
                    'vAlign' => 'middle',

                ],

                [
                    'attribute' => 'monthly_payment',
                    'format' => ['decimal', 2],
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'interest_amount_due',
                    'format' => ['decimal', 2],
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'principal_amount_due',
                    'format' => ['decimal', 2],
                    'pageSummary' => true,
                ],
                'balance',

                [
                    'attribute' => 'interest_amount_settled',
                    'format' => ['decimal', 2],
                    'pageSummary' => true,
                ],

                [
                    'attribute' => 'principal_amount_settled',
                    'format' => ['decimal', 2],
                    'pageSummary' => true,
                ],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'header' => 'Actions',

                    'template' => '{view}',
                    /*'buttons' => [
                        'liquidate' => function ($url, $model) {
                            $contract = \backend\models\ContractMaster::getContract($model->contract_ref_number);
                            if ($model->status == 'A' && strtotime($model->due_date) <= strtotime(date('Y-m-d')) && $contract->auth_stat == 'A' && yii::$app->User->can('LoanOfficer')) {
                                $url = ['contract-amount-due/liquidate', 'id' => $model->id];
                                return Html::a('<span class="fa fa-check"></span> Repay', $url, [
                                    'title' => 'Repay',
                                    'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                                    'class' => 'btn btn-warning',
                                    'data' => [
                                        'confirm' => Yii::t('app', 'Are you sure you want to repay this loan?'),
                                        'method' => 'post',
                                    ],

                                ]);
                            } elseif ($model->status == 'A' && strtotime($model->due_date) >= strtotime(date('Y-m-d')) && $contract->auth_stat == 'A' && yii::$app->User->can('LoanOfficer')) {
                                $url = ['contract-amount-due/pre-liquidate', 'id' => $model->id];
                                return Html::a('<span class="fa fa-check"></span> Pre Repay', $url, [
                                    'title' => 'Pre Repay',
                                    'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                                    'class' => 'btn btn-info',
                                    'data' => [
                                        'confirm' => Yii::t('app', 'Are you sure you want to repay this loan?'),
                                        'method' => 'post',
                                    ],

                                ]);
                            } elseif ($model->status == 'L' && $contract->auth_stat == 'A' && yii::$app->User->can('LoanOfficer')) {
                                $url = ['payment/reverse', 'id' => $model->id];
                                return Html::a('<span class="fa fa-retweet"></span> Reverse', $url, [
                                    'title' => 'Reverse',
                                    'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                                    'class' => 'btn btn-warning',
                                    'data' => [
                                        'confirm' => Yii::t('app', 'Are you sure you want to Repay this loan?'),
                                        'method' => 'post',
                                    ],

                                ]);
                            }

                        },

                    ]*/

                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            if(strtotime($model->due_date) <= strtotime(date('Y-m-d')) && \backend\models\ContractMaster::getAwaitingStatus($model->contract_ref_number)!='N' && yii::$app->User->can('LoanOfficer') && $model->status!='L') {
                                return Html::a('<span class="fa fa-pencil"></span>', '#', [
                                    'class' => 'activity-view-link',
                                    'title' => Yii::t('yii', 'View'),
                                    'data-toggle' => 'modal',
                                    'data-target' => '#activity-modal',
                                    'data-id' => $key,
                                    'data-pjax' => '0',

                                ]);
                            }
                        },
                    ],
                ],
            ];


            echo  GridView::widget([
                'dataProvider' => $dataProvider,


                'toolbar' => [

                    '{export}',
                    // '{toggleData}'
                ],
                'export' => [
                    'fontAwesome' => true,
                    'options' => [
                        'title' => 'Custom Title',
                        'subject' => 'PDF export',
                        'keywords' => 'pdf'
                    ],
                ],

                // 'pjax'=>true,
                'showHeader' => true,
                'columns' => $gridColumns,


                'showPageSummary' => true,
                'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                'filterRowOptions' => ['class' => 'kartik-sheet-style'],


            ]);
            Pjax::end();
        }
        ?>
        <?php Modal::begin([
            'id' => 'activity-modal',
            'header' => '<h4 class="modal-title">Repayment Form</h4>',
            'size'=>'modal-sm',

        ]); ?>

        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($payment, 'id')->hiddenInput(['maxlength' => true,'readonly'=>'readonly',])->label(false) ?>
        <?= $form->field($payment, 'contract_ref_number')->hiddenInput(['maxlength' => true,'readonly'=>'readonly',])->label(false) ?>
        <?= $form->field($payment, 'trn_dt')->textInput(['maxlength' => true,'readonly'=>'readonly',]) ?>

        <?= $form->field($payment, 'amount')->textInput(['maxlength' => true,]) ?>

        <?= $form->field($payment, 'payment_method')->dropDownList(\backend\models\PaymentMethod::getAll(),['prompt'=>'--Select--']) ?>

        <?= $form->field($payment, 'receipt')->textInput() ?>




        <div class="form-group text-right">
            <?=
            Html::Button(Yii::t('app', '<i class="fa fa-check"></i> Save'), [
                'class' => 'btn btn-primary',
                'value'=> 'Submit',
                'id'=>'repay-id',
                'name' => 'submit',
                ]);
            ?>
            <?= Html::Button(Yii::t('app', 'Cancel'), ['class' => 'btn btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>


        <?php Modal::end(); ?>

    </div>
</div>

<?php $this->registerJs(
    "$('.activity-view-link').click(function() {
$.get(
'index.php?r=contract-amount-reduce-due/get-repay',
{
id: $(this).closest('tr').data('key')
},
function (data) {
//$('.modal-body').html(data);
//('#activity-modal').modal();
  var myObj = JSON.stringify(data); 
  var myObj = JSON.parse(myObj);
    document.getElementById('contractpayment-id').value=myObj.data['id'];
    document.getElementById('contractpayment-contract_ref_number').value=myObj.data['contract_ref_number'];
    document.getElementById('contractpayment-trn_dt').value=myObj.data['due_date'];
    document.getElementById('contractpayment-amount').value=myObj.data['monthly_payment'];
}
);
});
"
); ?>






