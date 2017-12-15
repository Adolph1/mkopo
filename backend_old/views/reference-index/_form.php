<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ReferenceIndex */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reference-index-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'index_no')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'product')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'full_reference')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => 20]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
