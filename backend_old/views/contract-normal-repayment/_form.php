<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ContractNormalRepayment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-normal-repayment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contract_ref_number')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'due_date')->textInput() ?>

    <?= $form->field($model, 'contract_amount')->textInput() ?>

    <?= $form->field($model, 'interest')->textInput() ?>

    <?= $form->field($model, 'contract_outstanding')->textInput() ?>

    <?= $form->field($model, 'customer_installment')->textInput() ?>

    <?= $form->field($model, 'balance')->textInput() ?>

    <?= $form->field($model, 'month_factor')->textInput() ?>

    <?= $form->field($model, 'expected_installment')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
