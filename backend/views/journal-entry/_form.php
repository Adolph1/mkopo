<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\JournalEntry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="journal-entry-form" onload="getReference()">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'trn_dt')->widget(DatePicker::ClassName(),
            [
                //'name' => 'purchase_date',
                //'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Enter booking date', 'value'=>date('Y-m-d'),],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'autoclose' => true,
                    'todayHighlight' => true,

                ]
            ]);?>
    </div>
    <div class="col-md-6" id="ref-no">
    <?= $form->field($model, 'trn_ref_no')->textInput(['readonly'=>'readonly']) ?>
    </div>
</div>
    <div class="row">
        <div class="col-md-4 col-sm-12 col-xs-12">
    <?= $form->field($model, 'credit_account')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12">
    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12">
    <?= $form->field($model, 'debit_account')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 text-right">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
