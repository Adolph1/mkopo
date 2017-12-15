<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Group */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-8">
        <?= $form->field($model, 'group_name')->textInput(['maxlength' => true,'placeholder'=>'Enter group name']) ?>

    </div>
    <div class="col-md-4">
        <?= $model->isNewRecord ? $form->field($model, 'group_number')->textInput(['maxlength' => true,'value'=>\backend\models\Group::findLast()]) : $form->field($model, 'group_number')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>

    </div>
</div>

    <div class="row">
        <div class="col-md-8">
    <?= $form->field($model, 'branch_code')->dropDownList(\backend\models\Branch::getAll(),['prompt' => '--Select--']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'location')->textInput(['maxlength' => true,'placeholder' => 'Enter Location']) ?>

        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'loan_officer')->dropDownList(\backend\models\Employee::getAll(),['prompt' => '--Select--']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'registration_date')->widget(DatePicker::ClassName(),
                [
                    //'name' => 'purchase_date',
                    //'value' => date('d-M-Y', strtotime('+2 days')),
                    'options' => ['placeholder' => 'Enter registration date'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                        'autoclose'=>true,
                    ]
                ]);?>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Close'), ['index'], ['class' =>'btn btn-default']) ?>
    </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
