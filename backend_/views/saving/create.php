<?php

use yii\helpers\Html;
use yii\jui\AutoComplete;
use yii\web\JsExpression;


/* @var $this yii\web\View */
/* @var $model backend\models\Saving */

$this->title = Yii::t('app', 'Create Saving');
?>
<div id="loader1" style="display: none"></div>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-money"></i><strong> NEW SAVING</strong></h3>
    </div>

<div class="col-lg-4 col-md-8 col-sm-8 col-xs-8">
    <?php

    $data = \backend\models\Customer::find()
        ->select(['customer_no as value', 'customer_no as  label','concat(first_name," ",last_name) as value','concat(first_name, " ",last_name) as  label','id as id'])
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
                   
                     theUrl='http://localhost/mkopo/index.php?r=customer/search-customer&id='+id;
  
                    //alert(theUrl);
                    var xmlHttp = new XMLHttpRequest();
                    xmlHttp.open( \"GET\", theUrl, false ); // false for synchronous request
                    xmlHttp.send( null );
                    //alert(xmlHttp.responseText);

                    var myObj = JSON.parse(xmlHttp.responseText);
                    if(myObj.data){
                        //alert(myObj.data);
                        }
                     
                     
                     
                     if(xmlHttp.responseText == \"Undefined\") {

                    document.getElementById(\"saving-customer_number\").value = \"\";
                  



                }else{
               
                
                    document.getElementById(\"saving-customer_number\").value =myObj.data.customer_no;

                }
          
     
                 }")],
    ]);
    ?>

    <?= Html::activeHiddenInput($model, 'customer_detail',['id'=>'prd-id'])?>

</div>
    </div>
<hr>
<div class="row">
    <div class="col-md-12">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
