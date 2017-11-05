<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StudentPaymentScheduleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-payment-schedule-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'student_reg') ?>

    <?= $form->field($model, 'payment_type_id') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'year_of_study') ?>

    <?php // echo $form->field($model, 'amount_settled') ?>

    <?php // echo $form->field($model, 'last_update') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
