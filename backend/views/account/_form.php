<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'branch_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cust_ac_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ac_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cust_no')->textInput() ?>

    <?= $form->field($model, 'account_class')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ac_stat_no_dr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ac_stat_no_cr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ac_stat_no_block')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ac_stat_stop_pay')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ac_stat_dormant')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'acc_open_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ac_opening_bal')->textInput() ?>

    <?= $form->field($model, 'dormancy_date')->textInput() ?>

    <?= $form->field($model, 'dormancy_days')->textInput() ?>

    <?= $form->field($model, 'acc_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maker_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maker_stamptime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'checker_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'check_stamptime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mod_no')->textInput() ?>

    <?= $form->field($model, 'auth_stat')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
