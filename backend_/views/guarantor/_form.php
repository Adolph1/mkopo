<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Guarantor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guarantor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contract_ref_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'identification')->textInput() ?>

    <?= $form->field($model, 'identification_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'related_customer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maker_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maker_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>