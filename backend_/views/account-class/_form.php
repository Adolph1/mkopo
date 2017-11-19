<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountClass */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-class-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'acc_class')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dormancy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'record_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maker_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maker_stamptime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'checker_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'check_stamptime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
