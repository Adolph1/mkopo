<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Teller */

$this->title = Yii::t('app', 'New Transaction');
?>
<div class="row">
    <div class="col-md-6">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-file-o"></i><strong> POST NEW TRANSACTION</strong></h3>
    </div>
    <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12 text-right">

        <?= Html::a(Yii::t('app', '<i class="fa fa-file-o"></i> NEW TRANSACTION'), ['create'], ['class' =>yii::$app->User->can('LoanOfficer') ? 'btn btn-default text-green enabled':'btn btn-default text-green disabled']) ?>


        <?= Html::a(Yii::t('app', '<i class="fa fa-th text-black"></i> TRANSACTIONS LIST'), ['index'], ['class' => 'btn btn-default text-green']) ?>


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
