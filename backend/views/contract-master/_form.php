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
<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-file-o"></i><strong> NEW LOAN</strong></h3>
    </div>

</div>
<hr>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="btn-group btn-group-justified">

            <?= Html::a(Yii::t('app', '<i class="fa fa-file-o"></i> NEW LOAN'), ['create'], ['class' => 'btn btn-primary']) ?>


            <?= Html::a(Yii::t('app', '<i class="fa fa-th text-black"></i> LOANS CONTRACTS LIST'), ['index'], ['class' => 'btn btn-primary ']) ?>

        </div>
    </div>
</div>
<hr>
<?php $form = ActiveForm::begin(); ?>


        <div class="panel panel-default">
            <div class="panel-body">


    <div class="row">
    <div class="col-md-8">
        <?= $form->field($model, 'product')->dropDownList(\backend\models\Product::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>

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
                                <?= $form->field($model, 'customer_name')->textInput() ?>
                       
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
    <?= $form->field($model, 'main_component_rate')->textInput(['maxlength' => 200]) ?>
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

                            ]
                        ]);?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'frequency')->textInput(['maxlength' => 200,'onblur'=>'jsDispalydate(this)','onkeyup'=>'jsDispalydate(this)']) ?>
                    </div>
                    </div>


    <div class="form-group">
        <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>
    <script>
        function jsDispalydate(data)
        {
            var paymentdate=document.getElementById('contractmaster-payment_date').value;
            var frequency=document.getElementById('contractmaster-frequency').value;
            //alert(frequency);
            $.get("<?php echo Yii::$app->urlManager->createUrl(['contract-master/calcmaturitydate','frequency'=>'']);?>"+frequency + "&paymentdate=" +paymentdate,function(data) {
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