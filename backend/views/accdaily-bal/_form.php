<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AccdailyBal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accdaily-bal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'branch_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value_date')->textInput() ?>

    <?= $form->field($model, 'available_balance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Debit_tur')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Cedit_tur')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
