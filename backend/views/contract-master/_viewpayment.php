<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Button;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model backend\models\ContractMasterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-master-search">

    <?php $form = ActiveForm::begin(


    ); ?>

  

    <div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?= Yii::t('app', 'Payment Form'); ?>
        </div>
        <div class="panel-body">

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'contract_ref_number')->textInput(['maxlength' => 20,'readonly'=>'readonly']) ?>
            </div>
            <div class="col-md-6">
                <?php echo $form->field($model, 'due_date')->textInput(['maxlength' => 20,'readonly'=>'readonly']) ?>
            </div>

        </div>
        <?php
        $contractprincipal=$model->getPrincipal($model->contract_ref_number,$model->due_date);
        $contractinterest=$model->getInterest($model->contract_ref_number,$model->due_date);
        $contractinterest->amount_due=$contractinterest->amount_due-$contractinterest->amount_settled;
        $contractprincipal->amount_due=$contractprincipal->amount_due-$contractprincipal->amount_settled;

        ?>
        <div class="row">



            <div class="col-md-6">
                <?= $form->field($contractprincipal, 'amount_due')->textInput(['maxlength' => 20,'readonly'=>'readonly','value'=>$contractprincipal->amount_due])->label('Principal Due') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($contractprincipal, 'amount_settled')->textInput(['maxlength' => 20,'readonly'=>'readonly'])->label('Principal Settled')  ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($contractinterest, 'amount_due')->textInput(['maxlength' => 20,'readonly'=>'readonly','value'=>$contractinterest->amount_due])->label('Interest Due') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($contractinterest, 'amount_settled')->textInput(['maxlength' => 20,'readonly'=>'readonly'])->label('Interest Settled') ?>
            </div>

        </div>
            </div>
        </div>
</div>
        </div>
    </div>






    <?php ActiveForm::end(); ?>


</div>
