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
?>

<div class="system-setup-form">

    <?= $form->field($model, 'system_name')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'system_date')->textInput(['value'=>\backend\models\SystemDate::getCurrentDate()]) ?>

    <?= $form->field($model, 'system_rate')->textInput(['value'=>\backend\models\SystemRate::getSystemRate()]) ?>

    <?= $form->field($model, 'system_grace_period')->textInput() ?>

    <?= $form->field($model, 'system_version')->textInput(['maxlength' => 200]) ?>
    <?= $form->field($model, 'system_stage')->dropDownList(\backend\models\SystemStage::getArrayStages(),['prompt' => '--select--']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
