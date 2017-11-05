<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Clients');
?>

<div class="row">
    <div class="col-md-8">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-user text-yellow"></i><strong> Clients </strong></h3>
    </div>
    <div class="col-md-4">
        <?= Html::a(Yii::t('app', 'Add New'), ['create'], ['class' => 'btn btn-success btn-block']) ?>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'phone_number',
            'location',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>
    </div>
</div>
