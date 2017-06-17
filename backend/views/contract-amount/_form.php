<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ContractAmount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-amount-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contract_ref_number')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'due_date')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'amount_due')->textInput() ?>

    <?= $form->field($model, 'account_due')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'customer_number')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'amount_settled')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
