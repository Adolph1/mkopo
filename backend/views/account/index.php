<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Accounts');
?>
<div class="row">
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
    <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-sitemap"></i><strong> ACCOUNTS LIST</strong></h3>
</div>
    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 text-right">

        <?= Html::a(Yii::t('app', '<i class="fa fa-money text-yellow"></i> NEW ACCOUNT'), ['create'], ['class' => 'btn btn-default text-green']) ?>


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

            'branch_code',
            'cust_ac_no',
            'ac_desc',
            'cust_no',
            'account_class',
            // 'ac_stat_no_dr',
            // 'ac_stat_no_cr',
            // 'ac_stat_no_block',
            // 'ac_stat_stop_pay',
            // 'ac_stat_dormant',
            // 'acc_open_date',
            // 'ac_opening_bal',
            // 'dormancy_date',
            // 'dormancy_days',
            // 'acc_status',
            // 'maker_id',
            // 'maker_stamptime',
            // 'checker_id',
            // 'check_stamptime',
            // 'mod_no',
            // 'auth_stat',

            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $url=['view','id' => $model->cust_ac_no];
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
