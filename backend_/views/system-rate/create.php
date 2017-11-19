<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SystemRate */

$this->title = Yii::t('app', 'System Rate');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'System Rates'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-calendar-o"></i><strong> ADD SYSTEMS RATES</strong></h3>
    </div>

</div>
<hr>
<div class="system-rate-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
