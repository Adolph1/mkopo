<?php
/**
 * Created by PhpStorm.
 * User: adotech
 * Date: 11/1/17
 * Time: 9:22 AM
 */
use yii\helpers\Html;
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
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center"></div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center"><strong>Address</strong></div>
</div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center"><?= \backend\models\Customer::getFullNameByCustomerNumber($model->cust_no);?><br/><span id="account-id"><?= $model->cust_ac_no;?></span></div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center"><strong>From:</strong> <span class="text-primary" id="from-id"><?= \backend\models\SystemDate::getCurrentDate();?></span> <strong>To:</strong> <span class="text-primary" id="to-id"><?= \backend\models\SystemDate::getCurrentDate();?></span></div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center"><?= \backend\models\Customer::getCustomerAddress($model->cust_no);?></div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="statement-table" style="margin-left: 10px;"></div>
    </div>
    <div class="col-md-12 text-right" style="float: right">
        <?= Html::submitButton(Yii::t('app', '<i class="fa fa-print"></i> Print'), ['class' =>'btn btn-default','id'=>'print-preview']) ?>
    </div>
</div>
