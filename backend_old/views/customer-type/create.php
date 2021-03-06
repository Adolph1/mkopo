<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CustomerType */

$this->title = Yii::t('app', 'Create Customer Type');
?>
<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-sitemap"></i><strong> ADD NEW TYPE</strong></h3>
    </div>

</div>
<hr>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <div class="btn-group btn-group-justified">

        <?= Html::a(Yii::t('app', '<i class="fa fa-file-o text-black"></i> NEW TYPE'), ['create'], ['class' => 'btn btn-primary']) ?>


        <?= Html::a(Yii::t('app', '<i class="fa fa-th text-black"></i> TYPE LIST'), ['index'], ['class' => 'btn btn-primary ']) ?>

    </div>
    <hr>
</div>
</div>
<div class="row">
    <div class="col-md-12">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
