<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Eod */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eod-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'process_function')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'process_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'starttime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'endtime')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
