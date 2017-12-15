<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\ProductGroup;
use backend\models\TransactionType;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$form = ActiveForm::begin();
$prodgrp=ProductGroup::find()->all();
$listgroups=ArrayHelper::map($prodgrp,'group_name','group_name');
$form->field($model, 'product_group')->dropDownList(
    $listgroups,
    ['prompt'=>'Select...']);

$transtype=TransactionType::find()->all();

$listtrans=ArrayHelper::map($transtype,'type','type');
$form->field($model, 'product_type')->dropDownList(
    $listtrans,
    ['prompt'=>'Select...']);


?>

<div class="row">


    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('app', 'Product Form'); ?>
            </div>
            <div class="panel-body">
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'product_id')->textInput(['maxlength' => 200,'placeholder'=>'Enter product code']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'product_group')->dropDownList($listgroups, ['prompt'=>'--Select--']) ?>
            </div>
        </div>
        <div class="row" id="fund-id">
            <div class="col-md-12">
                <?= $form->field($model, 'fund')->dropDownList(\backend\models\Shareholder::getAll(),['prompt'=>'--Select--']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'product_descption')->textarea(['rows' => 5]) ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div id="loan-method">
        <div class="row">
            <div class="col-md-12" id="interest-method">
            <?= $form->field($model, 'interest_method')->dropDownList(\backend\models\Product::getArrayStatus(),['prompt'=>'--Select--']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'default_principal')->textInput(['placeholder'=>'Enter default principal']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'min_principal')->textInput(['placeholder'=>'Enter minimum principal']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'max_principal')->textInput(['placeholder'=>'Enter maximum principal']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'default_rate')->textInput(['placeholder'=>'Enter default rate']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'min_rate')->textInput(['placeholder'=>'Enter minimum rate']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'max_rate')->textInput(['placeholder'=>'Enter maximum rate']) ?>
            </div>
        </div>
        </div>

        <div class="row">
            <div class="col-md-12" id="product-type">
            <?= $form->field($model, 'product_type')->dropDownList($listtrans, ['prompt'=>'--Select--'],['style'=>'width:100px']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'product_remarks')->textInput(['maxlength' => 200,'placeholder'=>'Enter remarks']) ?>
            </div>
         </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'product_start_date')->widget(
                DatePicker::className(), [
                // inline too, not bad
                'inline' => false,
                // modify template for custom rendering
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',

                ],
                    'options'=>['placeholder'=>'Enter start date']
            ]);?>
         </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'product_end_date')->widget(
                            DatePicker::className(), [
                            // inline too, not bad
                            'inline' => false,
                            // modify template for custom rendering
                            //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                            'clientOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd',

                            ],
                            'options'=>['placeholder'=>'Enter end date']
                        ]);?>
                    </div>
                </div>
            </div>

</div>


    <div class="form-group text-right">
        <?= Html::a(Yii::t('app', '<i class="fa fa-times text-yellow"></i> Close'), ['index'], ['class' => 'btn btn-default text-green']) ?>
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save text-white"></i> Create' : '<i class="fa fa-save text-white"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-warning' : 'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); ?>
</div>
            </div>

        </div>
</div>
