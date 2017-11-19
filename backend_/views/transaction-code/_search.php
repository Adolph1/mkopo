<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TransactionCodeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-code-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'trn_id') ?>

    <?= $form->field($model, 'trn_code') ?>

    <?= $form->field($model, 'trn_description') ?>

    <?= $form->field($model, 'maker_id') ?>

    <?= $form->field($model, 'maker_stamptime') ?>

    <?php // echo $form->field($model, 'checker_id') ?>

    <?php // echo $form->field($model, 'checker_stamptime') ?>

    <?php // echo $form->field($model, 'record_stat') ?>

    <?php // echo $form->field($model, 'mod_no') ?>

    <?php // echo $form->field($model, 'auth_stat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
