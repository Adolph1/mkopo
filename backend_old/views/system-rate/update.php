<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SystemRate */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'System Rate',
]) . $model->id;
?>

<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-calendar-o"></i><strong> UPDATE RATES</strong></h3>
    </div>

</div>
<div class="system-rate-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
