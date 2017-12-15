<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ContractAmountPaid */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-amount-paid-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contract_ref_no')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'component')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'due_date')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'paid_date')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'currency_settled')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'account_settled')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'customer_number')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'amount_settled')->textInput() ?>

    <?= $form->field($model, 'inflow_outflow')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'base_amount')->textInput() ?>

    <?= $form->field($model, 'amount_prepaid')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'payment_status')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'accounting_passed')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'message_sent')->textInput(['maxlength' => 20]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
