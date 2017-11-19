<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SmsLog */

$this->title = Yii::t('app', 'Create Sms Log');
?>
<div class="row">
    <div class="col-md-8" >
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-file text-yellow"></i><strong> SMS Logs </strong></h3>
    </div>
    <div class="col-md-4">
        <?= Html::a(Yii::t('app', 'Logs List'), ['index'], ['class' => 'btn btn-info btn-block']) ?>
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
