<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\LiquidationType;

/* @var $this yii\web\View */
/* @var $model backend\models\ContractMasterSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$form = ActiveForm::begin(
    ['action'=>'payment','method'=>'post']
);
$liquid_type=LiquidationType::find()->all();

$listtypes=ArrayHelper::map($liquid_type,'id','type');
$form->field($duemodel, 'liquadation_type')->dropDownList(
    $listtypes,
[
'prompt'=>'Select...'
],
['id'=>'branch']
);
?>
<div class="contract-master-search">


  

    <div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?= Yii::t('app', 'Payment Form'); ?>
        </div>
        <div class="panel-body">

    <div class="form-group">
        <div class="row">
        <div class="col-md-6">
            <?php echo $form->field($duemodel, 'contract_ref_number')->textInput(['maxlength' => 20,'value'=>$id,'readonly'=>'readonly']) ?>
        </div>
            </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($duemodel, 'liquadation_type')->dropDownList($listtypes,
                    ['prompt'=>'--Select--'],['style'=>'width:100px']) ?>
            </div>
            <div class="col-md-6">
                <?php echo $form->field($duedate, 'due_date')->textInput(['maxlength' => 20,'readonly'=>'readonly','value'=>$duedate->due_date]) ?>
            </div>

        </div>

        <div class="row">



            <div class="col-md-6">
                <?= $form->field($duemodel, 'dueprincipal')->textInput(['maxlength' => 20,'readonly'=>'readonly','id'=>'principal'])->label('Principal Due') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($duemodel, 'settledprincipal')->textInput(['maxlength' => 20,'id'=>'newprincipal'])->label('Principal Settled')  ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($duemodel, 'dueinterest')->textInput(['maxlength' => 20,'readonly'=>'readonly','id'=>'interest'])->label('Interest Due') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($duemodel, 'settledinterest')->textInput(['maxlength' => 20,'id'=>'newinterest'])->label('Interest Settled') ?>
            </div>

        </div>
        <
        <div class="row" style="float: right;padding-right:10px">
            <?= Html::a('Pay Now', ['payment', 'id' => $id], ['class' => 'btn btn-primary','id'=>'paybtn']) ?>
            </div>
        <div class="row">
        <div id="message"></div>
    </div>
                </div>
            </div>
        </div>
</div>
        </div>
    </div>






    <?php ActiveForm::end(); ?>


</div>
