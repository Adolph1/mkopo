<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BankTransaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bank-transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'trn_dt')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'source_ref_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_reg_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_type')->textInput() ?>

    <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
