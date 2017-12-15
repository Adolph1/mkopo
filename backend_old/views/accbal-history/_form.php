<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AccbalHistory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accbal-history-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'branch_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bkg_date')->textInput() ?>

    <?= $form->field($model, 'acy_opening_balance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'acy_closing_balance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'acy_dr_tur')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'acy_cr_tur')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'available_closing')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'acy_closing_uncoll')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
