<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EodSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eod-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'process_function') ?>

    <?= $form->field($model, 'process_description') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'starttime') ?>

    <?php // echo $form->field($model, 'endtime') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
