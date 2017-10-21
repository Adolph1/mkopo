<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;


/* @var $this yii\web\View */
/* @var $model backend\models\ContractMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>



 <div class="panel-body">
     <legend class="scheduler-border" style="color:#005DAD">Loan Details</legend>
    <div class="row">
    <div class="col-md-8">
        <?= $form->field($model, 'product')->dropDownList(\backend\models\Product::getAllLoans(),['prompt'=>Yii::t('app','--Select--')]) ?>
    </div>
    <div class="col-md-4">
    <?= $form->field($model, 'contract_ref_no')->textInput(['maxlength' => 200,'readonly'=>'readonly']) ?>
    </div>
      </div>
      <div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'payment_method')->dropDownList(\backend\models\PaymentMethod::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>
    </div>
    <div class="col-md-4">
    <?= $form->field($model, 'amount')->textInput(['maxlength' => 20]) ?>
    </div>
    <div class="col-md-4">
    <?= $form->field($model, 'product_type')->textInput(['maxlength' => 20,'readonly'=>'readonly']) ?>
    </div>
      </div>
     <div class="row">
           <div class="col-md-8">
                <?= $form->field($model, 'customer_name')->dropDownList(\backend\models\Customer::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>
                    </div>
              <div class="col-md-4">
                <?= $form->field($model, 'customer_number')->textInput(['maxlength' => 200,'readonly'=>'readonly']) ?>
                        </div>
                    </div>


       <div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'booking_date')->widget(
            DatePicker::className(), [
            // inline too, not bad
            'inline' => false,
            // modify template for custom rendering
            //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',

            ]
        ]);?>
    </div>
    <div class="col-md-4">
      <?= $form->field($model, 'value_date')->widget(
    DatePicker::className(), [
        // inline too, not bad
         'inline' => false, 
         // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
           'format' => 'yyyy-mm-dd',

        ]
]);?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'maturity_date')->textInput(['maxlength' => 20,'readonly'=>'readonly']) ?>

    </div>
      </div>

         <div class="row">
    <div class="col-md-4">
    <?= $form->field($model, 'main_component_rate')->textInput(['maxlength' => 200,'value'=>\backend\models\SystemRate::getUserRate()]) ?>
    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'payment_date')->widget(
                            DatePicker::className(), [
                            // inline too, not bad
                            'inline' => false,

                            // modify template for custom rendering
                            //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                            'clientOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd',



                            ],
                            'options'=>['id'=>'datechange'],
                        ]);?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'frequency')->textInput(['maxlength' => 200]) ?>
                    </div>
                    </div>


     <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

             <?= $form->field($model, 'main_component_rate')->textInput(['maxlength' => 200,'value'=>\backend\models\SystemRate::getUserRate()]) ?>

         </div>
     </div>

<div class="row">
    <div class="col-md-12"><?= $form->field($model, 'loan_officer')->textInput(['maxlength' => 200,'placeholder'=>'Enter Loan officer']) ?></div>
</div>

                <div class="panel-body">
                    <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items', // required: css class selector
                        'widgetItem' => '.item', // required: css class
                        'limit' => 10, // the maximum times, an element can be cloned (default 999)
                        'min' => 1, // 0 or 1 (default 1)
                        'insertButton' => '.add-item', // css class
                        'deleteButton' => '.remove-item', // css class
                        'model' => $guarantors[0],
                        'formId' => 'dynamic-form',
                        'formFields' => [
                            'name',
                            'phone_number',
                            'identification',
                            'identification_number',

                        ],
                    ]); ?>

                    <div class="container-items"><!-- widgetContainer -->
                        <legend class="scheduler-border" style="color:#005DAD">Guarantors</legend>
                        <div class="item"><!-- widgetBody -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-right" style="margin-bottom: 5px">

                                        <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                        <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>

                                    </div>
                                </div>
                            </div>



                            <?php foreach ($guarantors as $i => $guarantor): ?>
                                <?php
                                // necessary for update action.
                                if (!$guarantor->isNewRecord) {
                                    echo Html::activeHiddenInput($guarantor, "[{$i}]id");
                                }
                                ?>
                                <div class="col-md-3"><?= $form->field($guarantor, "[{$i}]name")->textInput(['maxlength' => true,'placeholder'=>'Enter name']) ?></div>
                                <div class="col-md-3"><?= $form->field($guarantor, "[{$i}]phone_number")->textInput(['maxlength' => true,'placeholder'=>'Enter phone number']) ?></div>
                                <div class="col-md-3"><?= $form->field($guarantor, "[{$i}]identification")->dropDownList(\backend\models\CustomerIdentification::getAll(),['prompt'=>Yii::t('app','--Select type--')])?></div>
                                <div class="col-md-3"><?= $form->field($guarantor, "[{$i}]identification_number")->textInput(['maxlength' => true,'placeholder'=>'Enter identification number']) ?></div>


                            <?php endforeach; ?>


                        </div>
                    </div>
                    <?php DynamicFormWidget::end(); ?>
                </div>






    <div class="form-group">
        <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

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



</div>



