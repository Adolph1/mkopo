<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Customers');
?>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-sitemap text-green"></i><strong> CUSTOMER LOANS REPORT</strong></h3>
    </div>
</div>
<hr>
<div id="loader1" style="display: none"></div>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'customer_no')->dropDownList(\backend\models\Customer::getAll(),['prompt'=>Yii::t('app','--Select--'),'id'=>'report-customer-no']) ?>
    </div>
</div>
    <hr>
<?php ActiveForm::end(); ?>

<div class="row" style="background: white">
    <div class="col-lg-12 col-md-12 col-sm-12 text-center" style="padding: 10px"><h2><strong  id="customer-name"></strong></h2></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="margin-left: 10px;">
        <table class="table table-bordered" id="loans-table">
            <tr><th>Booking Date</th><th>Reference</th><th>Customer</th><th>Amount</th><th>Outstanding</th><th>Maturity</th><th>Status</th></tr>
        </table>
    </div>

</div>
