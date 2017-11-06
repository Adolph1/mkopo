<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SmsLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sms Logs');
?>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-file text-yellow"></i><strong> SMS Logs </strong></h3>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <?= Html::a(Yii::t('app', 'Compose SMS'), ['create'], ['class' => 'btn btn-info']) ?>
        </div>
</div>
<hr/>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',

            'to',
            'content:ntext',
            'created_dt',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>
    </div>
</div>
