<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SystemRateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'System Rates');
?>
<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-calendar-o"></i><strong> SYSTEMS RATES</strong></h3>
    </div>

</div>
<hr>
<div class="system-rate-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'user_rate',
            'system_rate',
            'last_updated',
            'last_maker',

            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{update}',
                'buttons'=>[
                    'update' => function ($url, $model) {
                        $url=['update','id' => $model->id];
                        return Html::a('<span class="fa fa-pencil-square-o"></span>', $url, [
                            'title' => 'Update',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-info',

                        ]);


                    },

                ]
            ],
        ],
    ]); ?>
</div>
