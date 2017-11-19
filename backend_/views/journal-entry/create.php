<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\JournalEntry */

$this->title = Yii::t('app', 'Create Journal Entry');
?>

<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-money text-green"></i><strong> NEW ENTRY</strong></h3>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-right">

        <?= Html::a(Yii::t('app', '<i class="fa fa-th text-black"></i> ENTRIES LIST'), ['index'], ['class' => 'btn btn-default text-green']) ?>

    </div>
</div>
<hr/>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
