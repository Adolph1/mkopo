<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['advancesearch'],
        'method' => 'get',
    ]); ?>

<div class="row">
    <div class="col-md-4">
    <?= $form->field($model, 'item_reference') ?>
    </div>
    <div class="col-md-4">
    <?= $form->field($model, 'item_name') ?>
    </div>
    <div class="col-md-4">
    <?= $form->field($model, 'year') ?>
    </div>
</div>
    <div class="row">
        <div class="col-md-3">
    <?= $form->field($model, 'location_id')->dropDownList(\backend\models\Location::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>
        </div>
        <div class="col-md-3">
    <?= $form->field($model, 'branch_id')->dropDownList(\backend\models\Branch::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>
        </div>
        <div class="col-md-3">
    <?= $form->field($model, 'department_id')->dropDownList(\backend\models\Department::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>
        </div>
        <div class="col-md-3">
    <?= $form->field($model, 'shelve_id')->dropDownList(\backend\models\Shelve::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>
        </div>
    </div>


        <div class="form-group">

<div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-3">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary btn-block']) ?>
    </div>
    <div class="col-md-3">
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-warning btn-block']) ?>
    </div>

    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>