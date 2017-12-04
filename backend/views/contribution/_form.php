<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Contribution */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contribution-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'product')->dropDownList(\backend\models\Product::getAllContributions(),['prompt'=>'--Select--']) ?>
        </div>
    </div>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'customer_number')->dropDownList(\backend\models\Customer::getAll(),['prompt'=>'--Select--']) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'trn_ref_no')->textInput(['readonly'=>'readonly']) ?>
    </div>
</div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'payment_type')->dropDownList(\backend\models\PaymentMethod::getAll(),['prompt'=>'--Select--']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'reference')->textInput(['placeholder'=>'Enter reference']) ?>
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'payment_date')->widget(DatePicker::ClassName(),
        [
            //'name' => 'purchase_date',
            //'value' => date('d-M-Y', strtotime('+2 days')),
            'options' => ['placeholder' => 'Enter payment date'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true,
                'autoclose'=>true,
            ]
        ]);?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'contribution_type')->dropDownList(\backend\models\ContributionType::getAll(),['prompt'=>'--Select--']) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'amount')->textInput(['placeholder'=>'Enter amount']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'period')->dropDownList(['M01'=>'M01','M02'=>'M02','M03'=>'M03','M04'=>'M04','M05'=>'M05','M06'=>'M06','M07'=>'M07','M08'=>'M08','M09'=>'M09','M10'=>'M10','M11'=>'M11','M12'=>'M12'],['prompt' => '--Select--']) ?>
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'financial_year')->textInput(['maxlength' => true,'readonly'=>'readonly','value'=>'FY'.date('Y')]) ?>
        </div>
    </div>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
