<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountBalSetting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-bal-setting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'account_class')->dropDownList(\backend\models\AccountClass::getAll(),['prompt' => '--Select--']) ?>

    <?= $form->field($model, 'minimum_balance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maker_id')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>

    <?= $form->field($model, 'last_update')->textInput(['readonly'=>'readonly']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
