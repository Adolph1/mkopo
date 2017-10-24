<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EodCycleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Eod Cycles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eod-cycle-index">

    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'stage',
            'start_time',
            'end_time',
            //'error_code',
            'status',
            'remarks',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>
</div>

<div class="row">
    <div class="col-md-2">
        <?= Html::Button(Yii::t('app', '<i class="fa fa-gear"></i> Run TI'), [
            'class' => 'btn btn-warning text-right',
            'value'=> 'Run',
            'id'=>'run-ti',
            'name' => 'submit',
        ]) ?></div>
    <div class="col-md-2">
        <?= Html::Button(Yii::t('app', '<i class="fa fa-gear"></i> Run EOTI'), [
            'class' => 'btn btn-warning text-right',
            'value'=> 'eoti',
            'id'=>'run-eod',
            'name' => 'submit',
        ]) ?></div>

    <div class="col-md-2">
        <?= Html::Button(Yii::t('app', '<i class="fa fa-gear"></i> Run EOFI'), [
            'class' => 'btn btn-warning text-right',
            'value'=> 'eofi',
            'id'=>'run-eod',
            'name' => 'submit',
        ]) ?></div>
    <div class="col-md-2">
        <?= Html::Button(Yii::t('app', '<i class="fa fa-gear"></i> Run EOD'), [
            'class' => 'btn btn-warning text-right',
            'value'=> 'eod',
            'id'=>'run-eod',
            'name' => 'submit',
        ]) ?></div>
</div>
