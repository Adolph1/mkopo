<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ShelveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Shelves');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12" style="margin-left: 10px">
    <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-th"></i><strong> SHELVES LIST</strong></h3>
    <hr>
</div>

<div class="shelve-index">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="btn-group btn-group-justified">

            <?= Html::a(Yii::t('app', '<i class="fa fa-file-o text-black"></i> NEW SHELVE'), ['create'], ['class' => 'btn btn-success btn-success ']) ?>


                <?= Html::a(Yii::t('app', '<i class="fa fa-th text-black"></i> SHELVES LIST'), ['create'], ['class' => 'btn btn-success btn-success ']) ?>

        </div>
        <hr>
    </div>
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            [

                'attribute'=>'loc_id',
                'value'=>'loc.location_name',
            ],

            'max_box_no',
            // 'status',
            // 'maker_id',
            // 'maker_time',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>
</div>
