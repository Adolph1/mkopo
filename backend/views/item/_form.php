<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model backend\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
        <div class="col-md-8">
    <?= $form->field($model, 'item_name')->textInput(['maxlength' => true,'placeholder'=>'Enter box name']) ?>
        </div>
        <div class="col-md-4">
    <?= $form->field($model, 'year')->textInput(['maxlength' => true,'placeholder'=>'Enter year']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'location_id')->dropDownList(\backend\models\Location::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'branch_id')->dropDownList(\backend\models\Branch::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>
        </div>
        <div class="col-md-2">
            <?php
            if($model->isNewRecord)
            {?>
            <?= $form->field($model, 'department_id')->dropDownList(['prompt'=>Yii::t('app','--Select--')]) ?>
            <?php
            }else
                {
                    ?>
            <?= $form->field($model, 'department_id')->dropDownList(\backend\models\Department::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>
            <?php
                }
                ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
        </div>
    </div>
    <?php
    if($model->isNewRecord)
    {?>


        <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $subitems[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'title',
                    'description',

                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
                <legend class="scheduler-border" style="color:#005DAD">Box Contents</legend>
                <div class="item"><!-- widgetBody -->

                    <div class="row">
                        <div class="col-md-12">
                    <div class="pull-right" style="margin-bottom: 5px">

                        <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                        <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>

                    </div>
                        </div>
                    </div>



                    <?php foreach ($subitems as $i => $subitem): ?>
                            <?php
                            // necessary for update action.
                            if (! $subitem->isNewRecord) {
                                echo Html::activeHiddenInput($subitem, "[{$i}]id");
                            }
                            ?>
                            <div class="col-md-6"><?= $form->field($subitem, "[{$i}]title")->textInput(['maxlength' => true,'placeholder'=>'Enter file name'])->label(false) ?></div>
                            <div class="col-md-6"><?= $form->field($subitem, "[{$i}]description")->textInput(['maxlength' => true,'placeholder'=>'Enter file details'])->label(false) ?></div>


                    <?php endforeach; ?>


                </div>
            </div>
            <?php DynamicFormWidget::end(); }?>
        </div>




    <div class="row">
    <div class="form-group">
        <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
        </div>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    $(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
        console.log("beforeInsert");
    });

    $(".dynamicform_wrapper").on("afterInsert", function(e, item) {
        console.log("afterInsert");
    });

    $(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
        if (! confirm("Are you sure you want to delete this item?")) {
            return false;
        }
        return true;
    });

    $(".dynamicform_wrapper").on("afterDelete", function(e) {
        console.log("Deleted item!");
    });

    $(".dynamicform_wrapper").on("limitReached", function(e, item) {
        alert("Limit reached");
    });
</script>

