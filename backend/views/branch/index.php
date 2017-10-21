<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BranchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Branches');
?>
<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-sitemap"></i><strong> BRANCHES LIST</strong></h3>
    </div>

</div>
<hr>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <div class="btn-group btn-group-justified">

        <?= Html::a(Yii::t('app', '<i class="fa fa-file-o text-black"></i> NEW BRANCH'), ['create'], ['class' => 'btn btn-primary']) ?>


        <?= Html::a(Yii::t('app', '<i class="fa fa-th text-black"></i> BRANCHES LIST'), ['index'], ['class' => 'btn btn-primary ']) ?>

    </div>
</div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'branch_code',
            'branch_name',
            'location',
            'status',
            //'maker_id',
            // 'maker_time',


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
