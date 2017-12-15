<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <?= !$model->isNewRecord ? $form->field($model, 'branch_code')->dropDownList(\backend\models\Branch::getBranchCodes(),['prompt'=>'--Select--','disabled'=>'disabled']) : $form->field($model, 'branch_code')->dropDownList(\backend\models\Branch::getBranchCodes(),['prompt'=>'--Select--']) ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <?= $form->field($model, 'cust_ac_no')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
    </div>
    <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">
        <?= $form->field($model, 'cust_no')->textInput(['readonly'=>'readonly']) ?>
    </div>
</div>
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-12 col-xs-12">
            <?= $form->field($model, 'account_class')->dropDownList(\backend\models\AccountClass::getAll(),['prompt'=>'--Select--']) ?>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
    <?= $form->field($model, 'ac_desc')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-12 col-xs-12">
            <?= $form->field($model, 'ac_opening_bal')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= Yii::t('app', 'Permissions'); ?>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <?= $form->field($model, 'ac_stat_no_cr')->checkbox(['maxlength' => true]) ?>
                                </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <?= $form->field($model, 'ac_stat_no_dr')->checkbox(['maxlength' => true]) ?>
                                    </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <?= $form->field($model, 'ac_stat_stop_pay')->checkbox(['maxlength' => true]) ?>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <?= $form->field($model, 'ac_stat_dormant')->checkbox(['maxlength' => true]) ?>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>


        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">
            <?php if(!$model->isNewRecord) echo $form->field($model, 'acc_open_date')->widget(
                DatePicker::className(), [
                // inline too, not bad
                'inline' => false,
                // modify template for custom rendering
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',

                ],
                'options'=>['disabled'=>'disabled']
            ]);?>
        </div>
        <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
            <?php if(!$model->isNewRecord) echo $form->field($model, 'ac_opening_bal')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
        </div>

    </div>


    <div class="form-group">
        <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
