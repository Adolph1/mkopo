<?php

use yii\helpers\Html;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model backend\models\Account */

$this->title = Yii::t('app', 'Update Account')
?>
<div id="loader1" style="display: none"></div>
<div id="loader"></div>
<div class="row">
    <div class="col-md-6">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-pencil text-blue"></i><strong> UPDATE ACCOUNT</strong></h3>
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

