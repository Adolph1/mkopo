<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StudentPaymentScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Student Payment Schedules');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-payment-schedule-index">

    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'student_reg',
            [
                'attribute'=>'payment_type_id',
                'value'=>'type.title'
            ],
            'amount',
            [
                'attribute'=>'year_of_study',
                'value'=>'yos.title',
            ],
            'amount_settled',
            'last_update',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>
</div>
