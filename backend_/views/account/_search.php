<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'branch_code') ?>

    <?= $form->field($model, 'cust_ac_no') ?>

    <?= $form->field($model, 'ac_desc') ?>

    <?= $form->field($model, 'cust_no') ?>

    <?= $form->field($model, 'account_class') ?>

    <?php // echo $form->field($model, 'ac_stat_no_dr') ?>

    <?php // echo $form->field($model, 'ac_stat_no_cr') ?>

    <?php // echo $form->field($model, 'ac_stat_no_block') ?>

    <?php // echo $form->field($model, 'ac_stat_stop_pay') ?>

    <?php // echo $form->field($model, 'ac_stat_dormant') ?>

    <?php // echo $form->field($model, 'acc_open_date') ?>

    <?php // echo $form->field($model, 'ac_opening_bal') ?>

    <?php // echo $form->field($model, 'dormancy_date') ?>

    <?php // echo $form->field($model, 'dormancy_days') ?>

    <?php // echo $form->field($model, 'acc_status') ?>

    <?php // echo $form->field($model, 'maker_id') ?>

    <?php // echo $form->field($model, 'maker_stamptime') ?>

    <?php // echo $form->field($model, 'checker_id') ?>

    <?php // echo $form->field($model, 'check_stamptime') ?>

    <?php // echo $form->field($model, 'mod_no') ?>

    <?php // echo $form->field($model, 'auth_stat') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
