<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TransactionCode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-code-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'trn_code')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'trn_description')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'maker_id')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'maker_stamptime')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'checker_id')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'checker_stamptime')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'record_stat')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'mod_no')->textInput() ?>

    <?= $form->field($model, 'auth_stat')->textInput(['maxlength' => 20]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
