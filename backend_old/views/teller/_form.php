<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model backend\models\Teller */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin(); ?>
<div id="loader1" style="display: none"></div>
    <div class="panel">
        <div class="panel panel-success">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-8 col-xs-8">
                    <?php

                    $data = \backend\models\Account::find()
                        ->select(['ac_desc as value', 'ac_desc as  label','cust_ac_no as cust_ac_no'])
                        //->where(['acc_status'=>'O'])
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
                    
                    $('#memberssearch-family_name_id').val(ui.item.ac_desc);
                    var id=ui.item.cust_ac_no;
                    //alert(ui.item.cust_ac_no);
                    $('#prod-id').html(id);
                     $('#loader1' ).show( 'slow', function(){
                 
                        document.getElementById('teller-txn_account').value=id;
                         //setTimeout(close(), 30000);
                         $('#loader1' ).hide( 'slow', function(){
                          
                         });
                        });
                       
                        
                  
                 }")],
                    ]);
                    ?>

                    <?= Html::activeHiddenInput($model, 'customer_detail',['id'=>'prd1-id'])?>

                </div>
            </div>
        </div>
        <div class="panel-body">
            <div id="loader1" style="display: none"></div>
        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'product')->dropDownList(\backend\models\Product::getAllTeller(),['prompt'=>Yii::t('app','--Select--')]) ?>

            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'reference')->textInput(['maxlength' => 200,'readonly'=>'readonly']) ?>
            </div>
        </div>
        <div class="row">


            <div class="col-md-8">
                <?= $form->field($model, 'txn_account')->textInput(['maxlength' => true,'readonly'=>'readonly'])?>

            </div>



            <div class="col-md-4">
                <?= $form->field($model, 'amount')->textInput(['maxlength' => true,'onblur'=>'jsOffsetamount(this)','onkeyup'=>'jsOffsetamount(this)']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'offset_account')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'offset_amount')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            </div>
        </div>
            <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
                </div>

            </div>


        </div>


    <?php ActiveForm::end(); ?>
    </div>
    </div>


<script>
function jsOffsetamount(data)
{
var amount=document.getElementById('teller-amount').value;


document.getElementById("teller-offset_amount").value = amount;



}
</script>
