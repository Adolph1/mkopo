<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SmsLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sms-log-form">

    <?php $form = ActiveForm::begin(); ?>
   <?= $form->field($model, 'send_to')->radioList(array('1'=>'Individual','2'=>'Group')); ?>
    <?= $form->field($model, 'to')->dropDownList(['prompt'=>Yii::t('app','--Select Client--')])->label(false) ?>


    <?= $form->field($model, 'content')->textarea(['rows' => 6,'value'=>\backend\models\SmsTemplate::getDefault()]) ?>

    <div class="row">
        <div class="form-group">
            <div class="col-md-2" style="float: right;">
                <?= Html::Button(Yii::t('app', '<i class="fa fa-paper-plane"></i> Send'), [
                    'class' => 'btn btn-warning btn-block',
                    'value'=> 'Approve',
                    'id'=>'student-id',
                    'name' => 'approve',
                ]) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
