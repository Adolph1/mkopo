<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MaturedLoanCharge */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matured-loan-charge-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contract_ref_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'matured_date')->textInput() ?>

    <?= $form->field($model, 'charge_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'months')->textInput() ?>

    <?= $form->field($model, 'last_update')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
