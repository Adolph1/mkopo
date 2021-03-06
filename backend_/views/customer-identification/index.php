<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomerIdentificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Customer Identifications');
?>


<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-contact"></i><strong> ADD NEW IDENTIFICATION</strong></h3>
    </div>

</div>
<hr>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="btn-group btn-group-justified">

            <?= Html::a(Yii::t('app', '<i class="fa fa-file-o text-black"></i> NEW IDENTIFICATION'), ['create'], ['class' => 'btn btn-primary']) ?>


            <?= Html::a(Yii::t('app', '<i class="fa fa-th text-black"></i> IDENTIFICATION LIST'), ['index'], ['class' => 'btn btn-primary ']) ?>

        </div>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'indicator',
            'maker_id',
            'maker_time',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>
    </div>
</div>
