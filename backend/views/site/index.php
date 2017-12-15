<?php

/* @var $this yii\web\View */

$this->title = 'PSS';
use yii\bootstrap\Html;
use backend\models\ContractMasterSearch;
use sjaakp\gcharts\PieChart;
use sjaakp\gcharts\LineChart;
use kartik\grid\GridView;
?>
<div class="site-index">
    <div class="row">
        <div class="col-md-4">
            <strong><span class="text-info">Pesa Secured System</span> - Dashboard</strong>
        </div>
        <div class="col-md-2">
            <?= Html::a(Yii::t('app', '<i class="fa fa-user-plus"></i> New Customer'), ['customer/create'],
                [
                    'class' =>Yii::$app->user->can('createContract') ? 'btn btn-default enabled':'btn btn-default disabled',

                ]);
            ?>
        </div>
        <div class="col-md-2">
            <?= Html::a(Yii::t('app', '<i class="fa fa-money"></i> New loan'), ['contract-master/create'],
                [
                    'class' =>Yii::$app->user->can('createContract') ? 'btn btn-default enabled':'btn btn-default disabled',

                ]);
            ?>
        </div>
        <div class="col-md-2">
            <?= Html::a(Yii::t('app', '<i class="fa fa-building-o"></i> New Teller Transaction'), ['teller/create'],
                [
                    'class' =>Yii::$app->user->can('createContract') ? 'btn btn-default enabled':'btn btn-default disabled',

                ]);
            ?>
        </div>

        <div class="col-md-2">
            <?= Html::a(Yii::t('app', '<i class="fa fa-money"></i> New Contribution'), ['contribution/create'],
                [
                    'class' =>Yii::$app->user->can('createContract') ? 'btn btn-default enabled':'btn btn-default disabled',

                ]);
            ?>
        </div>
    </div>
<hr/>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-purple"><i class="fa fa-user"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Customers</span>
                    <span class="info-box-number"><?= \backend\models\Customer::getCustomerCount();?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Active Loans</span>
                    <span class="info-box-number"><?= \backend\models\ContractMaster::getActiveLoanCount();?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-bank"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Savings</span>
                    <span class="info-box-number">41,410</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-purple"><i class="fa fa-building"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Groups</span>
                    <span class="info-box-number">41,410</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-solid bg-teal-gradient">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-th"></i>

                <h3 class="box-title">Today Transactions</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body border-radius-none">
                <?php
                $searchModel1 = new \backend\models\TodayEntrySearch();
                $dataProvider1 = $searchModel1->lineChart();
                ?>
                <?= \sjaakp\gcharts\ColumnChart::widget([
                    'height' => '400px',
                    'dataProvider' => $dataProvider1,
                    'columns' => [

                        [
                            'attribute'=>'module',
                            'value'=>function($model, $a, $i, $w) {
                               if($model->module=='DE'){
                                   return 'Savings';
                               }elseif ($model->module=='LD'){
                                   return 'Loans';
                               }elseif ($model->module=='JRN'){
                                   return 'Journal Entries';
                               }
                               elseif ($model->module=='MD'){
                                   return 'Contributions';
                               }
                            },
                            'type' => 'string',
                        ],
                        'amount:number',





                    ],

                ]) ?>
            </div>
            <!-- /.box-body -->

        </div>
        </div>
        <div class="col-md-6">
            <div class="box box-solid bg-teal-gradient">
                <div class="box-header ui-sortable-handle" style="cursor: move;">
                    <i class="fa fa-th"></i>

                    <h3 class="box-title">Customers per Branch</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>

                    </div>
                </div>
                <div class="box-body border-radius-none">
                    <?php
                    $searchModel1 = new \backend\models\CustomerSearch();
                    $dataProvider1 = $searchModel1->lineChart();
                    ?>
                    <?= \sjaakp\gcharts\ColumnChart::widget([
                        'height' => '400px',
                        'dataProvider' => $dataProvider1,
                        'columns' => [

                            [
                                'attribute'=>'branch_id',
                                'type' => 'string',
                                'value'=>function ($model){
                                    return $model->branch->branch_name;
                                }

                            ],
                            'customers:number',





                        ],

                    ]) ?>
                </div>
                <!-- /.box-body -->

            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid box-default">
                <div class="box-header ui-sortable-handle" style="cursor: move;">
                    <i class="fa fa-th"></i>

                    <h3 class="box-title"><strong>Awaiting for operations</strong></h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn bg-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body border-radius-none">
                    <div class="row">

                        <div class="col-md-4"><strong>Teller Module</strong></div>
                        <div class="col-md-4"><strong>Loans Module</strong></div>
                        <div class="col-md-4"><strong>Customer Module</strong></div>

                    </div>
                    <div class="row">
                        <div class="col-md-4 text-yellow">Unauthorised (<?= \backend\models\Teller::getUnauthorised()?>)</div>
                        <div class="col-md-4 text-yellow">Unapproved (<?= \backend\models\ContractMaster::getPendingCount();?>)</div>
                        <div class="col-md-4 text-yellow">Unapproved Customers</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4 text-green">Awaiting for disbursement (<?= \backend\models\ContractMaster::getAwaitingDisbursementCount()?>)</div>
                        <div class="col-md-4 text-yellow">Unapproved Accounts</div>
                    </div>
                </div>
                <!-- /.box-body -->

            </div>
        </div>
    </div>


</div>
