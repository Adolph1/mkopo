<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Groups');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
        <h3  style="color: #003b4c;font-family: Tahoma"><i class="fa fa-th text-green"></i><strong> GROUPS LIST</strong></h3>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-8 col-xs-8">


        <?= Html::a(Yii::t('app', '<i class="fa fa-plus text-yellow"></i> ADD NEW GROUP'), ['create'], ['class' => 'btn btn-default text-green']) ?>

    </div>
</div>
<hr/>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'group_number',
            'group_name',
            [
              'attribute'=>'branch_code',
                'value'=> 'branch.branch_name',
            ],
            'location',

            [
                'attribute'=>'loan_officer',
                'value'=> function ($model){
                    if($model->loan_officer!=null){
                        return \backend\models\Employee::getFullNameByEmpID($model->loan_officer);
                    }else{
                        return ' ';
                    }
                }
            ],
            'registration_date',
            'auth_status',
            'status',
            // 'maker_id',
            // 'maker_time',
            // 'checker_id',
            // 'checker_time',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>
    </div>
</div>
