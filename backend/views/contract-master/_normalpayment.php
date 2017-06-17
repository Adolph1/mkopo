<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use dosamigos\editable\Editable;
use yii\helpers\ArrayHelper;
use backend\models\LiquidationType;

/* @var $this yii\web\View */
/* @var $model backend\models\ContractMaster */

//$this->title = $model->contract_ref_no;
//$this->params['breadcrumbs'][] = ['label' => 'Contract Masters', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$form = ActiveForm::begin(

);
?>
<div class="col-md-12">
 <div class="panel panel-primary">
  <div class="panel-heading">
   <?= Yii::t('app', 'Payment Form'); ?>
  </div>
  <div class="panel-body">

   <div class="form-group">
    <div class="row">
     <div class="col-md-6">
      <?php echo $form->field($normalpay, 'contract_ref_number')->textInput(['maxlength' => 20,'value'=>$normalpay->contract_ref_number,'readonly'=>'readonly']) ?>
     </div>
     <div class="col-md-6">
      <?php echo $form->field($normalpay, 'due_date')->textInput(['maxlength' => 20,'readonly'=>'readonly','value'=>$normalpay->due_date]) ?>
     </div>
    </div>
    <div class="row">
     <div class="col-md-6">
      <?php echo $form->field($normalpay, 'expected_installment')->textInput(['maxlength' => 20,'value'=>$normalpay->expected_installment,'readonly'=>'readonly']) ?>
     </div>
     <div class="col-md-6">
      <?php echo $form->field($normalpay, 'customer_installment')->textInput(['maxlength' => 20,'value'=>'']) ?>
     </div>

    </div>
    <div class="row" style="float: right;padding-right:10px">
     <?= Html::submitButton($normalpay->isNewRecord ? 'Create' : 'Update', ['class' => $normalpay->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>
   </div>
  </div>
 <?php ActiveForm::end(); ?>
 </div>

