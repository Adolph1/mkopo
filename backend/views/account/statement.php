<?php
/**
 * Created by PhpStorm.
 * User: adotech
 * Date: 11/1/17
 * Time: 9:22 AM
 */
use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
?>
<style>
    #statement {
        box-shadow: 0px 1px 1px 1px #888888;
        padding-top: 5px;padding-bottom: 100px
    }
</style>
<div id="statement">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center text-primary"><h3>Account Statement</h3></div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center"><strong>Customer name</strong></div>
        <div class="col-lg-5 col-md-4 col-sm-12 col-xs-12 text-center"></div>
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 text-center"><strong>Address</strong></div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center"><?= \backend\models\Customer::getFullNameByCustomerNumber($model->cust_no);?><br/><span id="account-id"><?= $model->cust_ac_no;?></span></div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
            <?php

            // Client validation of date-ranges when using with ActiveForm
            $form = ActiveForm::begin();
            echo DatePicker::widget([
                'name' => 'from_date',
                'value' => \backend\models\SystemDate::getCurrentDate(),
                'options' => ['placeholder' => 'Select issue date ...','id'=>'from-id'],
                'pluginOptions' => [
                    'format' => 'yyyy-m-dd',
                    'todayHighlight' => true,
                    'autoclose'=>true
                ]
            ]);
            ?>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
            <?php
            echo DatePicker::widget([
                'name' => 'from_date',
                'value' => \backend\models\SystemDate::getCurrentDate(),
                'options' => ['placeholder' => 'Select issue date ...','id'=>'to-id'],
                'pluginOptions' => [
                    'format' => 'yyyy-m-dd',
                    'todayHighlight' => true,
                    'autoclose'=>true
                ]
            ]);
            ActiveForm::end();
            ?>

        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center"><?= \backend\models\Customer::getCustomerAddress($model->cust_no);?></div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            <?= Html::submitButton(Yii::t('app', '<i class="fa fa-search"></i> '), ['class' =>'btn btn-default','id'=>'load-data']) ?>
        </div>
    </div>

    <hr/>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="statement-table" style="margin-left: 10px;"></div>
    </div>
    <div class="col-md-12 text-right" style="float: right">
        <?= Html::submitButton(Yii::t('app', '<i class="fa fa-print"></i> Print'), ['class' =>'btn btn-default','id'=>'print-preview']) ?>
    </div>
</div>
