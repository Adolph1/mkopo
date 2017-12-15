<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ContributionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contribution-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'trn_ref_no') ?>

    <?= $form->field($model, 'trn_dt') ?>

    <?= $form->field($model, 'payment_date') ?>

    <?= $form->field($model, 'payment_type') ?>

    <?php // echo $form->field($model, 'customer_number') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'contribution_type') ?>

    <?php // echo $form->field($model, 'period') ?>

    <?php // echo $form->field($model, 'financial_year') ?>

    <?php // echo $form->field($model, 'reference') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'auth_stat') ?>

    <?php // echo $form->field($model, 'maker_id') ?>

    <?php // echo $form->field($model, 'maker_time') ?>

    <?php // echo $form->field($model, 'checker_id') ?>

    <?php // echo $form->field($model, 'checker_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
