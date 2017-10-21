<?php

/* @var $this yii\web\View */

$this->title = 'Mkopo Manager';
use yii\bootstrap\Html;
use backend\models\ContractMasterSearch;
use sjaakp\gcharts\PieChart;
use sjaakp\gcharts\LineChart;
use kartik\grid\GridView;
?>
<div class="site-index" >
    <div class="row">
        <div class="col-md-8">
        </div>
        <div class="col-md-1">
            <?= Html::a(Yii::t('app', '<i class="fa fa-user-plus"></i> New Customer'), ['customer/create'],
                [
                    'class' =>Yii::$app->user->can('createContract') ? 'btn btn-default enabled':'btn btn-default disabled',

                ]);
            ?>
        </div>
        <div class="col-md-1">
            <?= Html::a(Yii::t('app', '<i class="fa fa-money"></i> New loan'), ['contract-master/create'],
                [
                    'class' =>Yii::$app->user->can('createContract') ? 'btn btn-default enabled':'btn btn-default disabled',

                ]);
            ?>
        </div>
        <div class="col-md-1">
            <?= Html::a(Yii::t('app', '<i class="fa fa-building-o"></i> Post Deposit'), ['teller/create'],
                [
                    'class' =>Yii::$app->user->can('createContract') ? 'btn btn-default enabled':'btn btn-default disabled',

                ]);
            ?>
        </div>

        <div class="col-md-1">
            <?= Html::a(Yii::t('app', '<i class="fa fa-sitemap"></i> New Branch'), ['branch/create'],
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
                <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Customers</span>
                    <span class="info-box-number"><?= \backend\models\Customer::getCustomerCount();?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Loans</span>
                    <span class="info-box-number"><?= \backend\models\ContractMaster::getLoanCount();?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Active Loans</span>
                    <span class="info-box-number"><?= \backend\models\ContractMaster::getActiveLoanCount();?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Liquidated Loans</span>
                    <span class="info-box-number"><?= \backend\models\ContractMaster::getLiquidatedLoanCount();?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
<div class="row">
    <div class="col-md-8">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title text-center">Loans to be liquidated</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        <?php

                        $searchModel = new \backend\models\ContractAmountDueSearch();
                        $dataProvider = $searchModel->searchToLiquidate();


                        if($dataProvider!=null) {

                        echo GridView::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],


                                [
                                    'attribute'=>'customer_number',
                                    'header'=>'Customer',
                                    'value'=>function($model){
                                        return \backend\models\Customer::getFullNameByCustomerNumber($model->customer_number);
                                    }
                                ],
                                'customer_number',
                                'amount_due',
                                'component',
                                'due_date',



                                'amount_settled',
                                [
                                   'attribute'=>'status',
                                    'header'=>'Liquidation date',
                                    'value'=>function($model){

                                        if ((strtotime($model->due_date)) == (strtotime(date('Y-m-d')))) {
                                            return $model->liquate_time = 'Today';
                                        } elseif (strtotime($model->due_date) == (strtotime(date('Y-m-d').'+1 day'))) {
                                            return $model->liquate_time = 'Tomorrow';
                                        } elseif (strtotime($model->due_date) == (strtotime(date('Y-m-d').'-1 day'))) {
                                            return $model->liquate_time = 'Yesterday';
                                        }
                                        else
                                        {
                                            return $model->liquate_time = $model->due_date;
                                        }
                                    }
                                ],
                                'contract_ref_number',

                                [
                                    'class'=>'kartik\grid\ActionColumn',
                                    'header'=>'Actions',
                                    'template'=>'{liquidate}',
                                    'buttons'=>[
                                        'liquidate' => function ($url, $model) {
                                            if($model->status=='A' && strtotime($model->due_date)<=strtotime(date('Y-m-d'))) {
                                                $url = ['contract-amount-due/quick-liquidate', 'id' => $model->id];
                                                return Html::a('<span class="fa fa-check"></span> Liquidate', $url, [
                                                    'title' => 'Liquidate',
                                                    'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                                                    'class' => 'btn btn-warning',

                                                ]);
                                            }elseif($model->status=='A' && strtotime($model->due_date)>=strtotime(date('Y-m-d'))) {
                                                $url = ['contract-amount-due/quick-pre-liquidate', 'id' => $model->id];
                                                return Html::a('<span class="fa fa-check"></span> Pre liquidate', $url, [
                                                    'title' => 'Liquidate',
                                                    'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                                                    'class' => 'btn btn-info',

                                                ]);
                                            }

                                        },

                                    ]
                                ],
                            ],

                            //'showPageSummary' => true,


                        ]);




                        // Renders a export dropdown menu

                        // You can choose to render your own GridView separately



                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">

            <div class="col-md-12 text-center">
                <!-- small box -->
                <div class="small-box bg-white">
                    <div class="inner">
                        <?php
                        $searchModel1 = new ContractMasterSearch();
                        $dataProvider1 = $searchModel1->lineChart();
                        ?>
                        <?php /*\sjaakp\gcharts\LineChart::widget([
                            'height' => '400px',
                            'dataProvider' => $dataProvider1,
                            'columns' => [

                                'booking_date:date',
                                //'amount:number',
                                'total:number',




                                //'reported_date:date',




                            ],
                            'options' => [
                                'title' => 'Loans booked from '.date('Y').'-'.date('m').'-'.'01'.' To '. date('Y').'-'.date('m').'-'.'31',
                                //'class'=>'text-center'
                            ],
                        ])*/ ?>

                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
            </div><!-- ./col -->
        </div>
    </div>
</div>

</div>
