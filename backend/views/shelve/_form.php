<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Shelve */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shelve-form">


        <div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>


            <?= $form->field($model, 'loc_id')->dropDownList(\backend\models\Location::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>

    <?= $form->field($model, 'max_box_no')->textInput() ?>

     <?= $form->field($model, 'status')->dropDownList(['1'=>'Active','0'=>'disable'],['prompt'=>Yii::t('app','--Select--')]) ?>


    <div class="form-group">
        <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
</div>
