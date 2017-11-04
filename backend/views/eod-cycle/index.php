<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EodCycleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Eod Cycles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-server text-black"></i><strong> END OF DAY MONITOR</strong></h3>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-2">
        <?= Html::Button(Yii::t('app', '<i class="fa fa-gear"></i> Run EOTI'), [
            'class' => \backend\models\SystemSetup::getCurrentStage()==\backend\models\SystemStage::EOTI || \backend\models\SystemSetup::getCurrentStage()==\backend\models\SystemStage::TI ? 'btn btn-warning enabled text-right':'btn btn-warning disabled text-right',
            'value'=> 'Run',
            'id'=>'run-ti',
            //'name' => 'submit',
        ]) ?></div>

    <div class="col-md-2">
        <?= Html::Button(Yii::t('app', '<i class="fa fa-gear"></i> Run EOFI'), [
            'class' => \backend\models\SystemSetup::getCurrentStage()==\backend\models\SystemStage::EOFI ? 'btn btn-warning enabled text-right':'btn btn-warning disabled text-right',
            'value'=> 'Run EOFI',
            'id'=>'run-eofi',
            //'name' => 'submit',
        ]) ?></div>
    <div class="col-md-2">
        <?= Html::Button(Yii::t('app', '<i class="fa fa-gear"></i> Run EOD'), [
            'class' => \backend\models\SystemSetup::getCurrentStage()==\backend\models\SystemStage::EOD ? 'btn btn-warning enabled text-right':'btn btn-warning disabled text-right',
            'value'=> 'Run Eod',
            'id'=>'run-eod',
            'name' => 'EOD',
        ]) ?></div>
</div>
<div class="row">
    <div class="col-md-12">
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
</div>
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-server text-black"></i><strong> END OF DAY PROCESSES</strong></h3>
    </div>
</div>
<?php
$searchModel = new \backend\models\EodSearch();
$dataProvider = $searchModel->searchToday();
?>
<div class="row">
    <div class="col-md-12">
        <?= \fedemotta\datatables\DataTables::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'process_function',
                'process_description',
                'status',
                'starttime',
                'endtime',

                ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
            ],
        ]); ?>
    </div>
</div>

