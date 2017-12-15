<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\jui\AutoComplete;
use yii\web\JsExpression;


/* @var $this yii\web\View */
/* @var $model backend\models\ContractMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>



<div class="panel-body">
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
            <?= $form->field($model, 'payment_method')->dropDownList(\backend\models\ContractMaster::getArrayMethods(),['prompt'=>Yii::t('app','--Select--')]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'amount')->textInput(['maxlength' => 20]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'product_type')->textInput(['maxlength' => 20,'readonly'=>'readonly']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'customer_name')->dropDownList(\backend\models\Customer::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'settle_account')->dropDownList(['prompt'=>Yii::t('app','--Select--')]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'customer_number')->textInput(['maxlength' => 200,'readonly'=>'readonly']) ?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'booking_date')->widget(DatePicker::ClassName(),
                [
                    //'name' => 'purchase_date',
                    //'value' => date('d-M-Y', strtotime('+2 days')),
                    'options' => ['placeholder' => 'Enter booking date'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,
                        'todayHighlight' => true,
                    ]
                ]);?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'value_date')->widget(DatePicker::ClassName(),
                [
                    //'name' => 'purchase_date',
                    //'value' => date('d-M-Y', strtotime('+2 days')),
                    'options' => ['placeholder' => 'Enter value date'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,
                        'todayHighlight' => true,
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

            <?= $form->field($model, 'payment_date')->widget(DatePicker::ClassName(),
                [
                    //'name' => 'purchase_date',
                    //'value' => date('d-M-Y', strtotime('+2 days')),
                    'options' => ['placeholder' => 'Enter first payment date','id'=>'datechange'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,
                        'todayHighlight' => true,
                    ]
                ]);?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'frequency')->textInput(['maxlength' => 200,'onblur'=>'jsOffsetamount(this)','onkeyup'=>'jsOffsetamount(this)']) ?>
        </div>
    </div>



    <div class="row">

        <div class="col-md-12">
            <?php

            $data = \backend\models\Employee::find()
                ->select(['concat(first_name," ",last_name) as value','concat(first_name, " ",last_name)','id as id'])
                ->asArray()
                ->all();

            //echo 'Product Name' .'<br>';
            if($data!=null) {
                echo AutoComplete::widget([
                    'options' => [
                        'placeholder' => 'Enter Loan officer',
                        //'style'=>'width:300px;padding:8px',
                        'class' => 'form-control search-form'
                    ],
                    'clientOptions' => [
                        'source' => $data,
                        'minLength' => '3',
                        'autoFill' => true,
                        'select' => new JsExpression("function( event, ui ) {
                    
                    $('#memberssearch-family_name_id').val(ui.item.id);
                    var id=ui.item.id;
                    alert(ui.item.id);
                    $('#prod-id').html(id);
           
                        document.getElementById('contractmaster-loan_officer').value=id;
                  
                 }")],
                ]);
            }
            else{
                $data='Record not found';
                echo AutoComplete::widget([
                    'options' => [
                        'placeholder' => 'Enter Loan officer',
                        //'style'=>'width:300px;padding:8px',
                        'class' => 'form-control search-form'
                    ],
                    'clientOptions' => [
                        'source' => $data,
                        'minLength' => '3',
                        //'autoFill' => true,
                        'select' => new JsExpression("function( event, ui ) {
                    
                    $('#memberssearch-family_name_id').val(ui.item.id);
                    var id=ui.item.id;
                    alert(ui.item.id);
                    $('#prod-id').html(id);
           
                        document.getElementById('contractmaster-loan_officer').value=id;
                  
                 }")],
                ]);
            }
            ?>

            <?= Html::activeHiddenInput($model, 'officer_detail',['id'=>'prd-id'])?>

            <?= $form->field($model, 'loan_officer')->hiddenInput(['maxlength' => 200,'placeholder'=>'Enter Loan officer'])->label(false) ?>
        </div>
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

<script>
    function jsOffsetamount(data)
    {
        var frequency = document.getElementById('contractmaster-frequency').value;
        var paymentdate = document.getElementById('datechange').value;

        $.get("<?php echo Yii::$app->urlManager->createUrl(['contract-master/calcmaturitydate', 'paymentdate' => '']);?>" + paymentdate+'&frequency='+frequency, function (data) {
            //alert(data);
            document.getElementById("contractmaster-maturity_date").value = data;


        });



    }
</script>



