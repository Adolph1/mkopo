<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ContractAmountPaidSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-amount-paid-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'contract_ref_no') ?>

    <?= $form->field($model, 'component') ?>

    <?= $form->field($model, 'due_date') ?>

    <?= $form->field($model, 'paid_date') ?>

    <?php // echo $form->field($model, 'currency_settled') ?>

    <?php // echo $form->field($model, 'account_settled') ?>

    <?php // echo $form->field($model, 'customer_number') ?>

    <?php // echo $form->field($model, 'amount_settled') ?>

    <?php // echo $form->field($model, 'inflow_outflow') ?>

    <?php // echo $form->field($model, 'base_amount') ?>

    <?php // echo $form->field($model, 'amount_prepaid') ?>

    <?php // echo $form->field($model, 'payment_status') ?>

    <?php // echo $form->field($model, 'accounting_passed') ?>

    <?php // echo $form->field($model, 'message_sent') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
