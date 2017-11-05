<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StudentPaymentSchedule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-payment-schedule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'student_reg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_type_id')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year_of_study')->textInput() ?>

    <?= $form->field($model, 'amount_settled')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_update')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
