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

</div>
