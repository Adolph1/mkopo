<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\bootstrap\ActiveForm;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <?php $form = ActiveForm::begin(
        [
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-4',
                    'offset' => 'col-sm-offset-0',
                    'wrapper' => 'col-sm-8',
                    'error' => '',
                    'hint' => '',
                ],
            ],
        ]
    ); ?>

    <div class="col-lg-3 col-md-3 col-sm-8 col-xs-8">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-user text-green"></i><strong> CUSTOMER DETAILS</strong></h3>
    </div>

    <div class="col-lg-4 col-md-8 col-sm-8 col-xs-8">
        <?php

        $data = \backend\models\Customer::find()
            ->select(['customer_no as value', 'customer_no as  label','concat(first_name,", ",last_name) as value','concat(first_name, ", ",last_name) as  label','id as id'])
            ->asArray()
            ->all();

        //echo 'Product Name' .'<br>';
        echo AutoComplete::widget([
            'options'=>[
                'placeholder'=>'Search Customer',
                //'style'=>'width:300px;padding:8px',
                'class'=>'form-control search-form'
            ],
            'clientOptions' => [
                'source' => $data,
                'minLength'=>'3',
                'autoFill'=>true,
                'select' => new JsExpression("function( event, ui ) {
                    
                    $('#memberssearch-family_name_id').val(ui.item.id);
                    var id=ui.item.id;
                    //alert(ui.item.id);
                    $('#prod-id').html(id);
                     $('#loader1' ).show( 'slow', function(){
                      $.get('".Yii::$app->urlManager->createUrl(['customer/search','id'=>''])."'+id,function(data) {
                    
                        setTimeout(refresh, 30000);
                 
                        });

                     });
     
                 }")],
        ]);
        ?>

        <?= Html::activeHiddenInput($model, 'customer_detail',['id'=>'prd-id'])?>

    </div>
    <div class="col-lg-3 col-md-3 col-sm-8 col-xs-8">



        <?= Html::a(Yii::t('app', '<i class="fa fa-user-plus text-yellow"></i> ADD NEW CUSTOMER'), ['create'], ['class' => 'btn btn-default text-green']) ?>


        <?= Html::a(Yii::t('app', '<i class="fa fa-th text-yellow"></i> CUSTOMERS LIST'), ['index'], ['class' => 'btn btn-default text-green']) ?>

    </div>

    <div class="col-lg-2 col-md-2 col-sm-8 col-xs-8">

        <div class="btn-group">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <?php
                if($model->record_stat=='O') {

                    echo Html::a(Yii::t('app', '<i class="fa fa-pencil text-blue"></i> Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-default']) ;

                    echo Html::a(Yii::t('app', '<i class="fa fa-times text-red"></i> Disable'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-default',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this customer?'),
                            'method' => 'post',
                        ],
                    ]);
                } elseif($model->record_stat=='D'){
                    echo Html::a(Yii::t('app', '<i class="fa fa-check text-green"></i> Enable'), ['enable', 'id' => $model->id], [
                        'class' => 'btn btn-default',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to enable this customer?'),
                            'method' => 'post',
                        ],
                    ]);
                }

                ?>
            </ul>
        </div>

    </div>
</div>


<hr>
<div id="loader1" style="display: none"></div>
<div class="row">
    <div class="col-md-3">

    <legend class="scheduler-border text-info">Personal Details</legend>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'customer_no')->textInput(['maxlength' => true,'placeholder'=>'Enter first name','readonly'=>'readonly']) ?>
            </div>
        </div>
        <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true,'placeholder'=>'Enter first name','readonly'=>'readonly']) ?>
        </div>
    </div>

        <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true,'placeholder'=>'Enter middle name','readonly'=>'readonly']) ?>
        </div>
        </div>
        <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true,'placeholder'=>'Enter last name','readonly'=>'readonly']) ?>
        </div>
        </div>
        <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'branch')->dropDownList(\backend\models\Branch::getAll(),['prompt'=>Yii::t('app','--Select--'),'disabled'=>'disabled']) ?>
        </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'customer_type_id')->dropDownList(\backend\models\CustomerType::getAll(),['prompt'=>Yii::t('app','--Select--'),'disabled'=>'disabled']) ?>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'customer_category_id')->dropDownList(\backend\models\CustomerCategory::getAll(),['prompt'=>Yii::t('app','--Select--'),'disabled'=>'disabled']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'address')->textInput(['maxlength' => true,'placeholder'=>'Enter address','readonly'=>'readonly']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'mobile_no1')->textInput(['maxlength' => true,'placeholder'=>'Enter mobile number1','readonly'=>'readonly']) ?>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'mobile_no2')->textInput(['maxlength' => true,'placeholder'=>'Enter  mobile number2','readonly'=>'readonly']) ?>
            </div>
        </div>
        <div class="row">
        <div class="col-md-12">
            <?php if(!$model->isNewRecord) echo $form->field($model, 'record_stat')->textInput(['readonly'=>'readonly']) ?>
        </div>
        </div>
        <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true,'placeholder'=>'Enter email','readonly'=>'readonly']) ?>
        </div>
        </div>
    </div>
    <div class="col-md-9">
        <?php

        echo TabsX::widget([
            'position' => TabsX::POS_ABOVE,
            'align' => TabsX::ALIGN_LEFT,
            'items' => [
                [
                    'label' => 'Accounts',
                    'content' => $this->render('_accounts',['model'=>$model,]),
                    //'active' => $model->status==1,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['style' => 'background:#fff'],

                ],
                [
                    'label' => 'Savings',
                    'content' => $this->render('_savings',['model'=>$model]),
                    //'active' => $model->status==1,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['style' => 'background:#fff'],

                ],
                [
                    'label' => 'Loans',
                    'content' => $this->render('loans',['model'=>$model,]),
                    'visible'=>!$model->isNewRecord,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    //'active' => $model->status==2,
                    'options' => ['id' => 'partner',],

                ],
                [
                    'visible'=>!$model->isNewRecord,
                    'label' => 'Deposits',
                    //'content' => $this->render('_student',['student'=>$student,'model'=>$model]),
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    //'active' => $model->status==3,
                    'options' => ['id' => 'student','class'=>'disabled'],

                ],
                [
                    'visible'=>!$model->isNewRecord,
                    'label' => 'Shares',
                    //'content' => $this->render('_regfee',['regfee'=>$regfee,'model'=>$model]),
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    //'active' => $model->status==4,
                    'options' => ['id' => 'regfee','class'=>'disabled'],

                ],
                [
                    'visible'=>!$model->isNewRecord,
                    'label' => 'Collateral',
                    //'active' => $model->status==5,
                    //'content' => $this->render('_login',['model'=>$model,'user'=>$user,]),
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['id' => 'user',],

                ],
                [
                    'visible'=>!$model->isNewRecord,
                    'label' => 'Contacts',
                    //'active' => $model->status==6,
                    //'content' => $this->render('_preview',['model'=>$model,'student'=>$student,]),
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['id' => 'preview',],

                ],
                [
                    'visible'=>!$model->isNewRecord,
                    'label' => 'Identifications',
                    //'active' => $model->status==6,
                    //'content' => $this->render('_preview',['model'=>$model,'student'=>$student,]),
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['id' => 'preview',],

                ],
                [
                    'visible'=>!$model->isNewRecord,
                    'label' => 'Business Details',
                    //'active' => $model->status==6,
                    //'content' => $this->render('_preview',['model'=>$model,'student'=>$student,]),
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['id' => 'preview',],

                ],
            ],
        ]);
        ?>
        <div class="col-md-1"></div>
    </div>

    <div class="row">

    </div>
    <hr>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-center"></div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 text-center">
            <div class="row">
        <div class="col-md-3">
            <?php if(!$model->isNewRecord) echo $form->field($model, 'maker_id')->textInput(['readonly'=>'readonly']) ?>
        </div>
        <div class="col-md-3">
            <?php if(!$model->isNewRecord) echo $form->field($model, 'maker_time')->textInput(['readonly'=>'readonly']) ?>
        </div>
                <div class="col-md-3">
                    <?php if(!$model->isNewRecord) echo $form->field($model, 'checker_id')->textInput(['readonly'=>'readonly']) ?>
                </div>
                <div class="col-md-3">
                    <?php if(!$model->isNewRecord) echo $form->field($model, 'checker_time')->textInput(['readonly'=>'readonly']) ?>
                </div>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>
    </div>

<br/>
