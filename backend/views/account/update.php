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
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-pencil text-blue"></i><strong> UPDATE ACCOUNT</strong></h3>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 text-right">
    <?= Html::a(Yii::t('app', '<i class="fa fa-money text-yellow"></i> NEW ACCOUNT'), ['create'], ['class' => 'btn btn-default text-green']) ?>


    <?= Html::a(Yii::t('app', '<i class="fa fa-th text-yellow"></i> ACCOUNTS LIST'), ['index'], ['class' => 'btn btn-default text-green']) ?>

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

