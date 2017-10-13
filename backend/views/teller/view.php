<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Teller */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-list"></i><strong> TRANSACTION DETAILS</strong></h3>
    </div>

</div>
<hr>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="btn-group btn-group-justified">

            <?= Html::a(Yii::t('app', '<i class="fa fa-file-o"></i> POST NEW TRANSACTION'), ['create'], ['class' =>yii::$app->User->can('LoanOfficer') ? 'btn btn-primary enabled':'btn btn-primary disabled']) ?>


            <?= Html::a(Yii::t('app', '<i class="fa fa-th text-black"></i> TRANSACTIONS LIST'), ['index'], ['class' => 'btn btn-primary ']) ?>

        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
    <?php $form = ActiveForm::begin(); ?>

    <div class="panel-body">
        <legend class="scheduler-border" style="color:#005DAD">Transaction Details</legend>
        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'product')->dropDownList(\backend\models\Product::getAllTeller(),['prompt'=>Yii::t('app','--Select--'),'disabled'=>'disabled']) ?>

            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'reference')->textInput(['maxlength' => 200,'readonly'=>'readonly']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'related_customer')->dropDownList(\backend\models\Customer::getAll(),['prompt'=>Yii::t('app','--Select--'),'disabled'=>'disabled']) ?>

            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'amount')->textInput(['maxlength' => true,'readonly'=>'readonly','onblur'=>'jsOffsetamount(this)','onkeyup'=>'jsOffsetamount(this)']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'customer_number')->textInput(['maxlength' => true,'readonly'=>'readonly','value'=>$model->related_customer]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'offset_account')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'offset_amount')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <?php if(!$model->isNewRecord) echo $form->field($model, 'maker_id')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            </div>
            <div class="col-md-2">
                <?php if(!$model->isNewRecord) echo $form->field($model, 'maker_time')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            </div>
            <div class="col-md-4">
                <?php if(!$model->isNewRecord) echo $form->field($model, 'status')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            </div>

            <div class="col-md-2">
                <?php if(!$model->isNewRecord) echo $form->field($model, 'checker_id')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            </div>

            <div class="col-md-2">
                <?php if(!$model->isNewRecord) echo $form->field($model, 'checker_time')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php  if(!$model->isNewRecord) echo $form->field($model, 'current_balance')->textInput(['maxlength' => true,'readonly'=>'readonly','value'=>\backend\models\CustomerBalance::getBalance($model->related_customer)]) ?>
            </div>

        </div>

    </div>

    <div class="form-group">
        <div class="col-md-3 col-sm-3 col-xs-3 pull-right">

            <div class="btn-group btn-group-justified">
            <?php
            if($model->status=='U') {
                echo Html::a(Yii::t('app', '<i class="fa fa-check text-green"></i> Approve'), ['approve','id' => $model->id], ['class' =>yii::$app->User->can('tellerAuthoriser') ? 'btn btn-warning enabled btn-block':'btn btn-warning disabled btn-block']);
                echo Html::a(Yii::t('app', 'Edit'), ['update', 'id' => $model->id], ['class' =>yii::$app->User->can('tellerInput') ? 'btn btn-primary enabled btn-block':'btn btn-primary disabled btn-block']);
                echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => ['class' =>yii::$app->User->can('tellerInput') && $model->status!='A' ? 'btn btn-danger enabled btn-block':'btn btn-danger disabled btn-block'],
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]);
            }
            elseif($model->status=='R'){
                echo '';
            }
            elseif($model->status=='A'){
                echo Html::a(Yii::t('app', 'Reverse'), ['reverse', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-block',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to reverse this item?'),
                        'method' => 'post',
                    ],
                ]);
                //echo Html::a(Yii::t('app', 'Reverse'), ['reverse', 'id' => $model->id], ['class' => 'btn btn-primary btn-block']);
            }
            ?>
        </div>
        </div>

    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>
