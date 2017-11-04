<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AccbalHistorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accbal-history-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'branch_code') ?>

    <?= $form->field($model, 'account') ?>

    <?= $form->field($model, 'bkg_date') ?>

    <?= $form->field($model, 'acy_opening_balance') ?>

    <?php // echo $form->field($model, 'acy_closing_balance') ?>

    <?php // echo $form->field($model, 'acy_dr_tur') ?>

    <?php // echo $form->field($model, 'acy_cr_tur') ?>

    <?php // echo $form->field($model, 'available_closing') ?>

    <?php // echo $form->field($model, 'acy_closing_uncoll') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
