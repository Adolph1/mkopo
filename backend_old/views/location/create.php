<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Location */

$this->title = Yii::t('app', 'New Location');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Locations'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12" style="margin-left: 20px">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-sitemap"></i><strong> ADD NEW LOCATION</strong></h3>
    </div>

</div>
<hr>
<div class="location-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
