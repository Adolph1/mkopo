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
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-file-o"></i><strong> LOAN DETAILS</strong></h3>
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

    <div class="panel-body">


        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'product')->dropDownList(\backend\models\Product::getAll(),['prompt'=>Yii::t('app','--Select--'),'disabled'=>'disabled']) ?>

            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'contract_ref_no')->textInput(['maxlength' => 200,'readonly'=>'readonly']) ?>
            </div>
        </div>


        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'payment_method')->dropDownList(\backend\models\PaymentMethod::getAll(),['prompt'=>Yii::t('app','--Select--'),'disabled'=>'disabled']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'amount')->textInput(['maxlength' => 20,'readonly'=>'readonly']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'product_type')->textInput(['maxlength' => 20,'readonly'=>'readonly']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'customer_name')->textInput(['readonly'=>'readonly','value'=>Customer::getFullNameByCustomerNumber($model->customer_number)]) ?>

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
                    'options'=>['readonly'=>'readonly'],
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
                    'options'=>['readonly'=>'readonly'],
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
                <?= $form->field($model, 'main_component_rate')->textInput(['maxlength' => 200,'readonly'=>'readonly']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'payment_date')->widget(
                    DatePicker::className(), [
                    // inline too, not bad
                    'inline' => false,
                    'options'=>['readonly'=>'readonly'],
                    // modify template for custom rendering
                    //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',

                    ]
                ]);?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'frequency')->textInput(['maxlength' => 200,'readonly'=>'readonly','onblur'=>'jsDispalydate(this)','onkeyup'=>'jsDispalydate(this)']) ?>
            </div>
        </div>

        <div class="row">
            <legend class="scheduler-border" style="color:#005DAD">Guarantors List</legend>
            <div class="col-md-12">
            <?php
            $searchModel = new \backend\models\GuarantorSearch();
            $dataProvider = $searchModel->searchByReference($model->contract_ref_no);
            ?>
            <?= \fedemotta\datatables\DataTables::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                   // 'id',
                    'name',
                    'phone_number',
                    [
                        'attribute'=>'identification',
                        'value'=>'identificationID.name',
                    ],

                    'identification_number',
                    //'related_customer',
                    // 'maker_id',
                    // 'maker_time',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-md-4 col-sm-4 col-xs-4 pull-right">
                    <div class="btn-group btn-group-justified">
                        <?php
                      if($model->contract_status=='L'){
                            echo Html::a(Yii::t('app', 'Reverse'), ['update', 'id' => $model->contract_ref_no], ['class' => 'btn btn-primary btn-block']);
                            echo Html::a(Yii::t('app', 'View Schedule'), ['update', 'id' => $model->contract_ref_no], ['class' => 'btn btn-primary btn-block']);
                        }
                        elseif($model->contract_status=='A') {
                            echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->contract_ref_no], [
                                'class' => 'btn btn-danger btn-block',
                                'data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                            ]);
                            echo Html::a(Yii::t('app', 'View Schedule'), ['schedule', 'id' => $model->contract_ref_no], ['class' => 'btn btn-primary btn-block']);
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>



