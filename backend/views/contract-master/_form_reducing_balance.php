<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use backend\models\Product;
use yii\helpers\ArrayHelper;
use backend\models\Customer;
use backend\models\Branch;
use backend\models\PaymentMethod;
use backend\models\Account;

/* @var $this yii\web\View */
/* @var $model backend\models\ContractMaster */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<?php
$transtype=Product::find()
    ->where(['product_group' =>'Loans'])
    ->All();



$listproduct=ArrayHelper::map($transtype,'product_id','product_id');
$form->field($model, 'product')->dropDownList(
    $listproduct,
['prompt'=>'Select...']);


$custs=Customer::find()->all();

$listcusts=ArrayHelper::map($custs,'customer_no','customer_name');
$form->field($model, 'customer_name')->dropDownList(
    $listcusts,
    ['prompt'=>'Select...']);


$paymeth=PaymentMethod::find()->all();

$listmethods=ArrayHelper::map($paymeth,'method','method');
$form->field($model, 'payment_method')->dropDownList(
    $listmethods,
    ['prompt'=>'Select...']);



?>
<?php //yii\bootstrap\Progress::widget(['percent' => 10, 'label' => 'test']); ?>

<div class="col-md-12" style="font-size: 120%;">

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('app', 'Customer Form'); ?>
            </div>
            <div class="panel-body">


    <div class="row">

    <div class="col-md-8">
        <?= $form->field($model, 'product')->dropDownList($listproduct,
            ['prompt'=>'--Select--'],['style'=>'width:100px']) ?>

    </div>

    <div class="col-md-4">
    <?= $form->field($model, 'contract_ref_no')->textInput(['maxlength' => 200,'readonly'=>'readonly']) ?>
    </div>
      </div>


      <div class="row">
    <div class="col-md-4">
 <?= $form->field($model, 'payment_method')->dropDownList($listmethods,
        ['prompt'=>'--Select--'],['style'=>'width:100px']) ?>

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
                            <?= $form->field($model, 'customer_name')->dropDownList($listcusts,
                    ['prompt'=>'--Select--'],['style'=>'width:100px']) ?>

                       
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
                 <?= $form->field($model, 'payment_date')->widget(
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
    <?= $form->field($model, 'main_component_rate')->textInput(['maxlength' => 200]) ?>
    </div>
             <div class="col-md-4">
                 <?= $form->field($model, 'frequency')->textInput(['maxlength' => 200,'onblur'=>'jsDispalydate(this)','onkeyup'=>'jsDispalydate(this)']) ?>
             </div>
      </div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); ?>
    <script>
        function jsDispalydate(data)
        {
            var paymentdate=document.getElementById('contractmaster-payment_date').value;
            var frequency=document.getElementById('contractmaster-frequency').value;
            //alert(frequency);
            $.get("<?php echo Yii::$app->urlManager->createUrl('contract-master/calcmaturitydate?frequency=');?>"+frequency + "&paymentdate=" +paymentdate,function(data) {
                //alert(data);
                document.getElementById("contractmaster-maturity_date").value = data;


            });

        }
    </script>
</div>
</div>
    <div id="prodid">

    </div>
</div>