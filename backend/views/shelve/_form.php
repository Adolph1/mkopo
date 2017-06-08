<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Shelve */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shelve-form">
    <div class="panel panel-success">
        <div class="panel-heading">
            <?= Yii::t('app', 'Shelve Form'); ?>
        </div>
        <div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_id')->dropDownList(\backend\models\Branch::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>

    <?= $form->field($model, 'dept_id')->dropDownList(['prompt'=>Yii::t('app','--Select--')]) ?>

    <?= $form->field($model, 'max_box_no')->textInput() ?>

     <?= $form->field($model, 'status')->dropDownList(['1'=>'Active','0'=>'disable'],['prompt'=>Yii::t('app','--Select--')]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
