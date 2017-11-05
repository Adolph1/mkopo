<?php

/* @var $this yii\web\View */

$this->title = 'SMSinfo System';
use yii\bootstrap\Html;
use sjaakp\gcharts\PieChart;
use sjaakp\gcharts\LineChart;
?>
<div class="site-index" >
    <div class="row">
        <div class="col-md-8">
        </div>
        <div class="col-md-2">
            <?= Html::a(Yii::t('app', '<i class="fa fa-user-plus"></i> New Client'), ['client/create'],
                [
                    'class' =>'btn btn-default enabled',

                ]);
            ?>
        </div>
        <div class="col-md-2">
            <?= Html::a(Yii::t('app', '<i class="fa fa-building-o"></i> New Group'), ['contribution/create'],
                [
                     'class' =>'btn btn-default enabled',
                ]);
            ?>
        </div>

    </div>
    <hr/>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total clients</span>
                            <span class="info-box-number"><?= \backend\models\Client::getClientCount();?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->


                <!-- /.col -->
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total monthly sent sms</span>
                            <span class="info-box-number"><?= \backend\models\SmsLog::getMonthlySmsCount();?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="box box-primary">
                           
                            <!-- /.box-header -->
                            <div class="box-body">
                                <ul class="products-list product-list-in-box">
                                       <?php
                   $searchModel = new \backend\models\SmsLogSearch();
                    $dataProvider = $searchModel->PieChart();
                    ?>
                    <?= PieChart::widget([
                        'height' => '400px',
                        'dataProvider' => $dataProvider,
                        'columns' => [


                            'created_dt:string',

                            'total:number',
                            //'reported_date:date',

                        ],
                        'options' => [
                            'title' => 'SMS sent from '.date('Y').'-01-'.'01'.' To '. date('Y').'-'.date('m').'-'.'31',
                        ],
                    ]) ?>


                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        <!-- /.col -->
      
  
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php
                    $searchModel1 = new \backend\models\SmsLogSearch();
                    $dataProvider1 = $searchModel1->lineChart();
                    ?>
                    <?= LineChart::widget([
                        //'height' => '400px',
                        'dataProvider' => $dataProvider1,
                        'columns' => [
                            //'fc_period:string',
                            //'fc_year:string',
                            'created_dt:date',
                            //'amount:number',
                            'total:number',

                        ],
                        'options' => [
                            'title' => 'Sms sent from '.date('Y').'-'.date('m').'-'.'01'.' To '. date('Y').'-'.date('m').'-'.'31'

                            //'class'=>'text-center'
                        ],
                    ]) ?>


        </div>
    </div>
</div>
