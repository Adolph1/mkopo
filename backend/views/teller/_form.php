<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Teller */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teller-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel-body">
        <legend class="scheduler-border" style="color:#005DAD">Transaction Details</legend>
        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'product')->dropDownList(\backend\models\Product::getAllTeller(),['prompt'=>Yii::t('app','--Select--')]) ?>

            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'reference')->textInput(['maxlength' => 200,'readonly'=>'readonly']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'related_customer')->dropDownList(\backend\models\Customer::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>

            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'amount')->textInput(['maxlength' => true,'onblur'=>'jsOffsetamount(this)','onkeyup'=>'jsOffsetamount(this)']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'customer_number')->textInput(['maxlength' => true,'readonly'=>'readonly'])?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'offset_account')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'offset_amount')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            </div>
        </div>

    </div>

    <div class="form-group">
        <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>


<script>
function jsOffsetamount(data)
{
var amount=document.getElementById('teller-amount').value;


document.getElementById("teller-offset_amount").value = amount;



}
</script>
