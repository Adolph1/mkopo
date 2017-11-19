<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ContractAmountReduceDueSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-amount-reduce-due-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'contract_ref_number') ?>

    <?= $form->field($model, 'due_date') ?>

    <?= $form->field($model, 'monthly_payment') ?>

    <?= $form->field($model, 'interest_amount_due') ?>

    <?php // echo $form->field($model, 'principal_amount_due') ?>

    <?php // echo $form->field($model, 'balance') ?>

    <?php // echo $form->field($model, 'interest_amount_settled') ?>

    <?php // echo $form->field($model, 'principal_amount_settled') ?>

    <?php // echo $form->field($model, 'account_due') ?>

    <?php // echo $form->field($model, 'customer_number') ?>

    <?php // echo $form->field($model, 'inflow_outflow') ?>

    <?php // echo $form->field($model, 'basis_amount_tag') ?>

    <?php // echo $form->field($model, 'adjusted_amount') ?>

    <?php // echo $form->field($model, 'scheduled_linkage') ?>

    <?php // echo $form->field($model, 'amount_prepaid') ?>

    <?php // echo $form->field($model, 'original_due_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
