<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ContractBalance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-balance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contract_ref_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contract_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contract_outstanding')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
