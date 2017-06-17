<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ContractAmountDue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-amount-due-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contract_ref_no')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'component')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'due_date')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'amount_due')->textInput() ?>

    <?= $form->field($model, 'currency_amt_due')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'account_due')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'customer_number')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'amount_settled')->textInput() ?>

    <?= $form->field($model, 'inflow_outflow')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'basis_amount_tag')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'adjusted_amount')->textInput() ?>

    <?= $form->field($model, 'scheduled_linkage')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'component_type')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'amount_prepaid')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'original_due_date')->textInput(['maxlength' => 200]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
