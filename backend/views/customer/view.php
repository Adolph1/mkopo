<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row" style="background: #eee">
    <div class="col-md-1">
        <?= \backend\models\Customer::getImage($model->id);?>
    </div>
    <div class="col-md-11">
        <h3 style="color: #003b4c;font-family: Tahoma; padding: 30px"><?= strtoupper($model->first_name. ' ' .$model->last_name);?></strong></h3>
    </div>

</div>
<hr>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="btn-group btn-group-justified">

            <?= Html::a(Yii::t('app', '<i class="fa fa-user-plus"></i> ADD NEW CUSTOMER'), ['create'], ['class' => 'btn btn-primary']) ?>


            <?= Html::a(Yii::t('app', '<i class="fa fa-th text-black"></i> CUSTOMERS LIST'), ['index'], ['class' => 'btn btn-primary ']) ?>

        </div>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-md-12">
    <?php $form = ActiveForm::begin(); ?>
    <legend class="scheduler-border" style="color:#005DAD">Personal Details</legend>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true,'placeholder'=>'Enter first name','readonly'=>'readonly']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true,'placeholder'=>'Enter middle name','readonly'=>'readonly']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true,'placeholder'=>'Enter last name','readonly'=>'readonly']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'identification_id')->dropDownList(\backend\models\CustomerIdentification::getAll(),['prompt'=>Yii::t('app','--Select--'),'disabled'=>'disabled']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'identification_number')->textInput(['maxlength' => true,'placeholder'=>'Enter identification number','readonly'=>'readonly']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'expire_date')->widget(DatePicker::ClassName(),
                [
                    //'name' => 'purchase_date',
                    //'value' => date('d-M-Y', strtotime('+2 days')),
                    'options' => ['placeholder' => 'Enter expire date','readonly'=>'readonly'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                    ]
                ]);?>
        </div>
    </div>
    <legend class="scheduler-border" style="color:#005DAD">Contacts Details</legend>
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true,'placeholder'=>'Enter address','readonly'=>'readonly']) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'mobile_no1')->textInput(['maxlength' => true,'placeholder'=>'Enter mobile number1','readonly'=>'readonly']) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'mobile_no2')->textInput(['maxlength' => true,'placeholder'=>'Enter  mobile number2','readonly'=>'readonly']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true,'placeholder'=>'Enter email','readonly'=>'readonly']) ?>
        </div>
    </div>
    <legend class="scheduler-border" style="color:#005DAD">Other Details</legend>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'customer_type_id')->dropDownList(\backend\models\CustomerType::getAll(),['prompt'=>Yii::t('app','--Select--'),'disabled'=>'disabled']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'customer_category_id')->dropDownList(\backend\models\CustomerCategory::getAll(),['prompt'=>Yii::t('app','--Select--'),'disabled'=>'disabled']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'branch_id')->dropDownList(\backend\models\Branch::getAll(),['prompt'=>Yii::t('app','--Select--'),'disabled'=>'disabled']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php if(!$model->isNewRecord) echo $form->field($model, 'customer_no')->textInput(['readonly'=>'readonly']) ?>
        </div>
        <div class="col-md-2">
            <?php if(!$model->isNewRecord) echo $form->field($model, 'maker_id')->textInput(['readonly'=>'readonly']) ?>
        </div>
        <div class="col-md-2">
            <?php if(!$model->isNewRecord) echo $form->field($model, 'maker_time')->textInput(['readonly'=>'readonly']) ?>
        </div>
        <div class="col-md-2">
            <?php if(!$model->isNewRecord) echo $form->field($model, 'record_stat')->textInput(['readonly'=>'readonly']) ?>
        </div>
    </div>
        <div class="row">
            <div class="col-md-4">
                <?php  if(!$model->isNewRecord) echo $form->field($model, 'current_balance')->textInput(['maxlength' => true,'readonly'=>'readonly','value'=>\backend\models\CustomerBalance::getBalance($model->customer_no)]) ?>
            </div>

        </div>
    <div class="row">
        <div class="form-group">
            <div class="col-md-4 col-sm-4 col-xs-4 pull-right">
                <div class="btn-group btn-group-justified">
                <?php
                if($model->record_stat!='D') {

                    echo Html::a(Yii::t('app', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-block']) ;
                }
                elseif($model->record_stat=='O'){
                    echo Html::a(Yii::t('app', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-block']);
                }

                ?>
                <?php
                if($model->record_stat!='D') {
                    echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger btn-block',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]);
                }
                elseif($model->record_stat=='O'){
                    echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-block']);
                }
                ?>

                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>
<br/>
