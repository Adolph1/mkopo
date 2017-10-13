<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SystemDateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'System Dates');
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-calendar-o"></i><strong> SYSTEM DATES</strong></h3>
    </div>

</div>
<hr>
<div class="system-date-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'previous_working_day',
            'current_working_day',
            'next_working_day',

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
