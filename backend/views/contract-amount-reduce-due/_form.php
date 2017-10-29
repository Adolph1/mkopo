<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ContractAmountReduceDue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-amount-reduce-due-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contract_ref_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'due_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'monthly_payment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'interest_amount_due')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'principal_amount_due')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'balance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'interest_amount_settled')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'principal_amount_settled')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'account_due')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inflow_outflow')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'basis_amount_tag')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adjusted_amount')->textInput() ?>

    <?= $form->field($model, 'scheduled_linkage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount_prepaid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'original_due_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
