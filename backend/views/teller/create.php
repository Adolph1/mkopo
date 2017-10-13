<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Teller */

$this->title = Yii::t('app', 'New Transaction');
?>
<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-file-o"></i><strong> POST NEW TRANSACTION</strong></h3>
    </div>

</div>
<hr>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="btn-group btn-group-justified">

            <?= Html::a(Yii::t('app', '<i class="fa fa-file-o"></i> POST NEW TRANSACTION'), ['create'], ['class' =>yii::$app->User->can('LoanOfficer') ? 'btn btn-primary enabled':'btn btn-primary disabled']) ?>


            <?= Html::a(Yii::t('app', '<i class="fa fa-th text-black"></i> TRANSACTIONS LIST'), ['index'], ['class' => 'btn btn-primary ']) ?>

        </div>
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
