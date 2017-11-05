<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Groups');
?>
<div class="row">
    <div class="col-md-8">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-user text-yellow"></i><strong> Groups </strong></h3>
    </div>
    <div class="col-md-4">
        <?= Html::a(Yii::t('app', 'Add Group'), ['create'], ['class' => 'btn btn-success btn-block']) ?>
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
            'group_name',
            //'status',

             [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $url=['view','id' => $model->id];
                        return Html::a('<span class="fa fa-eye"></span>', $url, [
                            'title' => 'View',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-info',

                        ]);


                    },

                ]
            ],
        ],
    ]); ?>
    </div>
    
</div>
