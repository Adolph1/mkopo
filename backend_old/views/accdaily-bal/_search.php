<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AccdailyBalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accdaily-bal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'branch_code') ?>

    <?= $form->field($model, 'account') ?>

    <?= $form->field($model, 'value_date') ?>

    <?= $form->field($model, 'available_balance') ?>

    <?php // echo $form->field($model, 'Debit_tur') ?>

    <?php // echo $form->field($model, 'Cedit_tur') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
