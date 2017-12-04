<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContributionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Contributions');
?>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
        <h3  style="color: #003b4c;font-family: Tahoma"><i class="fa fa-money text-green"></i><strong> CONTRIBUTIONS LIST</strong></h3>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-8 col-xs-8">


        <?= Html::a(Yii::t('app', '<i class="fa fa-plus text-yellow"></i> NEW CONTRIBUTION'), ['create'], ['class' => 'btn btn-default text-green']) ?>

    </div>
</div>
<hr/>
<div class="contribution-index">
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
       //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'trn_ref_no',
            [
                'attribute'=>'contribution_type',
                'value'=>'type.title',
            ],
            'payment_date',
            [
                'attribute'=>'customer_number',
                'value'=>function ($model){

                    return \backend\models\Customer::getFullNameByCustomerNumber($model->customer_number);
                }
            ],
             'amount',
            [
                'attribute'=>'payment_type',
                'value'=>'payment.method_name',
            ],
             'period',
             'financial_year',
            'trn_dt',
            // 'reference',
            // 'description


            'auth_stat',
            // 'maker_id',
            // 'maker_time',
            // 'checker_id',
            // 'checker_time',

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
