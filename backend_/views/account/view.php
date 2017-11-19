<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\tabs\TabsX;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model backend\models\Account */

$this->title = $model->cust_ac_no;
?>
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-money text-green"></i><strong> ACCOUNT DETAILS</strong></h3>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 text-right">
        <?php

        $data = \backend\models\Account::find()
            ->select(['ac_desc as value', 'ac_desc as  label','cust_ac_no as cust_ac_no'])
            ->asArray()
            ->all();

        //echo 'Product Name' .'<br>';
        echo AutoComplete::widget([
            'options'=>[
                'placeholder'=>'Search Account',
                //'style'=>'width:300px;padding:8px',
                'class'=>'form-control search-form'
            ],
            'clientOptions' => [
                'source' => $data,
                'minLength'=>'3',
                'autoFill'=>true,
                'select' => new JsExpression("function( event, ui ) {
                    
                    $('#memberssearch-family_name_id').val(ui.item.ac_desc);
                    var id=ui.item.cust_ac_no;
                    alert(ui.item.cust_ac_no);
                        $('#loader1' ).show( 'slow', function(){
                      $.get('".Yii::$app->urlManager->createUrl(['account/search','id'=>''])."'+id,function(data) {
                    
                        setTimeout(refresh, 30000);
                 
                        });

                     });
                  
                 }")],
        ]);
        ?>

        <?= Html::activeHiddenInput($model, 'customer_detail',['id'=>'prd1-id'])?>

    </div>
<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 text-center">

    <?= Html::a(Yii::t('app', '<i class="fa fa-money text-yellow"></i> NEW ACCOUNT'), ['create'], ['class' => 'btn btn-default text-green']) ?>


    <?= Html::a(Yii::t('app', '<i class="fa fa-th text-yellow"></i> ACCOUNTS LIST'), ['index'], ['class' => 'btn btn-default text-green']) ?>


        <div class="btn-group">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <?php
                if($model->acc_status=='O') {

                    echo Html::a(Yii::t('app', '<i class="fa fa-pencil text-blue"></i> Edit'), ['update', 'id' => $model->cust_ac_no], ['class' => 'btn btn-default']) ;

                    echo Html::a(Yii::t('app', '<i class="fa fa-times text-red"></i> Disable'), ['delete', 'id' => $model->cust_ac_no], [
                        'class' => 'btn btn-default',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to Disable this customer?'),
                            'method' => 'post',
                        ],
                    ]);
                } elseif($model->acc_status=='D'){
                    echo Html::a(Yii::t('app', '<i class="fa fa-check text-green"></i> Enable'), ['enable', 'id' => $model->cust_ac_no], [
                        'class' => 'btn btn-default',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to enable this customer?'),
                            'method' => 'post',
                        ],
                    ]);
                }

                ?>
            </ul>

    </div>

</div>

</div>
<hr>
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'branch_code',
            'cust_ac_no',
            'ac_desc',
            'cust_no',
            'account_class',
            [
                    'attribute'=>'ac_stat_no_dr',
                    'value'=>function ($model){
                        if($model->ac_stat_no_dr==\backend\models\ContractMaster::ACTION_NO){
                            return 'NO';
                        }elseif ($model->ac_stat_no_dr==\backend\models\ContractMaster::ACTION_YES){
                            return 'YES';
                        }
                    }
            ],
            [
                'attribute'=>'ac_stat_no_cr',
                'value'=>function ($model){
                    if($model->ac_stat_no_cr==\backend\models\ContractMaster::ACTION_NO){
                        return 'NO';
                    }elseif ($model->ac_stat_no_cr==\backend\models\ContractMaster::ACTION_YES){
                        return 'YES';
                    }
                }
            ],
            [
                'attribute'=>'ac_stat_no_block',
                'value'=>function ($model){
                    if($model->ac_stat_no_block==\backend\models\ContractMaster::ACTION_NO){
                        return 'NO';
                    }elseif ($model->ac_stat_no_block==\backend\models\ContractMaster::ACTION_YES){
                        return 'YES';
                    }
                }
            ],
            [
                'attribute'=>'ac_stat_stop_pay',
                'value'=>function ($model){
                    if($model->ac_stat_stop_pay==\backend\models\ContractMaster::ACTION_NO){
                        return 'NO';
                    }elseif ($model->ac_stat_stop_pay==\backend\models\ContractMaster::ACTION_YES){
                        return 'YES';
                    }
                }
            ],
            [
                'attribute'=>'ac_stat_dormant',
                'value'=>function ($model){
                    if($model->ac_stat_dormant==\backend\models\ContractMaster::ACTION_NO){
                        return 'NO';
                    }elseif ($model->ac_stat_dormant==\backend\models\ContractMaster::ACTION_YES){
                        return 'YES';
                    }
                }
            ],
            'acc_open_date',
            'ac_opening_bal',
            'dormancy_date',
            'dormancy_days',
            'maker_id',
            'maker_stamptime',
            'checker_id',
            'check_stamptime',
            'acc_status',
            'auth_stat',
        ],
    ]) ?>

        <p style="float: right">
            <?php
            if($model->acc_status!='D' && $model->auth_stat=='U') {
                echo Html::a(Yii::t('app', '<i class="fa fa-check text-green"></i> Authorize'), ['approve', 'id' => $model->cust_ac_no], [
                    'class' => 'btn btn-warning',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to approve this Account?'),
                        'method' => 'post',
                    ],
                ]);
            }
            ?>
        </p>
    </div>
    <div id="loader1" style="display: none"></div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <?php

        echo TabsX::widget([
            'position' => TabsX::POS_ABOVE,
            'align' => TabsX::ALIGN_LEFT,
            'items' => [
                [
                    'label' => 'Account Statement',
                    'content' => $this->render('statement',['model'=>$model,]),
                    //'active' => $model->status==1,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['style' => 'background:#fff'],

                ],
                [
                    'label' => 'Available Balance',
                    'content' => $this->render('balance',['model'=>$model,]),
                    //'active' => $model->status==1,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['style' => 'background:#fff'],

                ],
                [
                    'label' => 'Daily Balances',
                    'content' => $this->render('historyBalance',['model'=>$model,]),
                    //'active' => $model->status==1,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['style' => 'background:#fff'],

                ],
                [
                    'label' => 'Linked Loans',
                    'content' => $this->render('linkedLoans',['model'=>$model,]),
                    //'active' => $model->status==1,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['style' => 'background:#fff'],

                ],

            ],
        ]);
        ?>
        <div class="col-md-1"></div>
    </div>
</div>
