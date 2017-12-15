<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Saving */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="saving-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">
            <?= $form->field($model, 'trn_date')->textInput() ?>
        </div>
        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'customer_number')->textInput(['maxlength' => true]) ?>
        </div>
    </div>




    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fc_period')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fc_year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_method')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reference')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maker_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maker_time')->textInput() ?>

    <?= $form->field($model, 'auth_stat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'checker_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'checker_time')->textInput() ?>

    <?= $form->field($model, 'next_pay_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
