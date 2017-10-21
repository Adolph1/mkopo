<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">
    <div class="panel panel-success">
        <div class="panel-heading">Employee Form</div>
        <div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_of_birth')->widget(DatePicker::ClassName(),
        [
            //'name' => 'purchase_date',
            // 'value' => date('d-M-Y', strtotime('+2 days')),
            //'options' => ['placeholder' => 'To date...'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true
            ]
        ]);?>

    <?= $form->field($model, 'job_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_id')->dropDownList(\backend\models\Branch::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>

            <?= $form->field($model, 'department_id')->dropDownList(\backend\models\Department::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>
        <?php
        if($model->isNewRecord)
        {?>
            <?= $form->field($user, 'username')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($user, 'password')->passwordInput(['maxlength' => 255]) ?>

            <?= $form->field($user, 'repassword')->passwordInput(['maxlength' => 255]) ?>

            <?= $form->field($user, 'email')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($user, 'role')->dropDownList(User::getArrayRole(),['prompt'=>Yii::t('app','--Select--')]) ?>

            <?= $form->field($user, 'status')->dropDownList(User::getArrayStatus(),['prompt'=>Yii::t('app','--Select--')]) ?>
<?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
        </div>
    </div>

