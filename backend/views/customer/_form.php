<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>
    <legend class="scheduler-border" style="color:#005DAD">Personal Details</legend>
    <div class="row">
        <div class="col-md-4">
    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true,'placeholder'=>'Enter first name']) ?>
        </div>
        <div class="col-md-4">
    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true,'placeholder'=>'Enter middle name']) ?>
        </div>
        <div class="col-md-4">
    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true,'placeholder'=>'Enter last name']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'identification_id')->dropDownList(\backend\models\CustomerIdentification::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>
        </div>
            <div class="col-md-4">
    <?= $form->field($model, 'identification_number')->textInput(['maxlength' => true,'placeholder'=>'Enter identification number']) ?>
            </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'expire_date')->widget(DatePicker::ClassName(),
                        [
                            //'name' => 'purchase_date',
                            //'value' => date('d-M-Y', strtotime('+2 days')),
                            'options' => ['placeholder' => 'Enter expire date'],
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
    <?= $form->field($model, 'address')->textInput(['maxlength' => true,'placeholder'=>'Enter address']) ?>
        </div>
        <div class="col-md-2">
    <?= $form->field($model, 'mobile_no1')->textInput(['maxlength' => true,'placeholder'=>'Enter mobile number1']) ?>
        </div>
        <div class="col-md-2">
    <?= $form->field($model, 'mobile_no2')->textInput(['maxlength' => true,'placeholder'=>'Enter  mobile number2']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
    <?= $form->field($model, 'email')->textInput(['maxlength' => true,'placeholder'=>'Enter email']) ?>
        </div>
    </div>
    <legend class="scheduler-border" style="color:#005DAD">Other Details</legend>
    <div class="row">
        <div class="col-md-4">
    <?= $form->field($model, 'customer_type_id')->dropDownList(\backend\models\CustomerType::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>
        </div>
        <div class="col-md-4">
    <?= $form->field($model, 'customer_category_id')->dropDownList(\backend\models\CustomerCategory::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>
        </div>
        <div class="col-md-4">
    <?= $form->field($model, 'branch_id')->dropDownList(\backend\models\Branch::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
    <?= $form->field($model, 'customer_photo')->fileInput() ?>
        </div>
        <div class="col-md-2">
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
    <div class="form-group">
        <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Next') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
        </div>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<br/>
