<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\ProductGroup;
use backend\models\TransactionType;
use yii\helpers\ArrayHelper;

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

<div class="product-form">
    <div class="col-md-12" style="font-size: 120%;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('app', 'Product Form'); ?>
            </div>
            <div class="panel-body">
<div class="row">
    <div class="col-md-4">

    <?= $form->field($model, 'product_id')->textInput(['maxlength' => 200]) ?>
    </div>

    <div class="col-md-4">
    <?= $form->field($model, 'product_group')->dropDownList($listgroups,
        ['prompt'=>'--Select--'],['style'=>'width:100px']) ?>
</div>
</div>
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'product_descption')->textInput(['maxlength' => 200]) ?>
                    </div>
                </div>
     <div class="row">
    <div class="col-md-6">
    <?= $form->field($model, 'product_type')->dropDownList($listtrans,
        ['prompt'=>'--Select--'],['style'=>'width:100px']) ?>
    </div>
         <div class="col-md-6">

    <?= $form->field($model, 'product_remarks')->textInput(['maxlength' => 200]) ?>
         </div>
         </div>
                <div class="row">
         <div class="col-md-6">
    <?= $form->field($model, 'product_start_date')->textInput(['maxlength' => 200]) ?>
         </div>
                    <div class="col-md-6">
    <?= $form->field($model, 'product_end_date')->textInput(['maxlength' => 200]) ?>
                    </div>

                    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
            </div>

        </div>
</div>
