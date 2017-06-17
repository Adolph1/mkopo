<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\SystemDates;
use backend\models\SystemRates;
use backend\models\GracePeriod;

/* @var $this yii\web\View */
/* @var $model backend\models\SystemSetup */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$form = ActiveForm::begin();
$sysrates=SystemRates::find()->all();

$listrates=ArrayHelper::map($sysrates,'id','rate_name');
$form->field($model, 'system_rate')->dropDownList(
    $listrates,
    ['prompt'=>'Select...']);
?>

<div class="system-setup-form">



    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'system_name')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'system_date')->textInput() ?>

    <?= $form->field($model, 'system_rate')->dropDownList($listrates,
        ['prompt'=>'--Select--']) ?>

    <?= $form->field($model, 'system_grace_period')->textInput() ?>

    <?= $form->field($model, 'system_version')->textInput(['maxlength' => 200]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
