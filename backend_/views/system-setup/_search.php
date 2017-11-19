<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SystemSetupSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="system-setup-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'system_name') ?>

    <?= $form->field($model, 'system_date') ?>

    <?= $form->field($model, 'system_rate') ?>

    <?= $form->field($model, 'system_grace_period') ?>

    <?php // echo $form->field($model, 'system_version') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
