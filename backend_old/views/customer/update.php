<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Customer',
]) . $model->id;
?>

<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-pencil-square text-danger"></i> UPDATE CUSTOMER : <?= strtoupper($model->first_name. ' ' .$model->last_name);?></strong></h3>
    </div>

</div>
<hr>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="btn-group btn-group-justified">

            <?= Html::a(Yii::t('app', '<i class="fa fa-user-plus"></i> ADD NEW CUSTOMER'), ['create'], ['class' => 'btn btn-primary']) ?>


            <?= Html::a(Yii::t('app', '<i class="fa fa-th text-black"></i> CUSTOMERS LIST'), ['index'], ['class' => 'btn btn-primary ']) ?>

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
