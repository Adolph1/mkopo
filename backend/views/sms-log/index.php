<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SmsLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sms Logs');
?>
<div class="row">
    <div class="col-md-8">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-file text-yellow"></i><strong> SMS Logs </strong></h3>
    </div>
        <div class="col-md-4">
            <?= Html::a(Yii::t('app', 'Compose SMS'), ['create'], ['class' => 'btn btn-info btn-block']) ?>
        </div>
</div>
<div class="row">
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
