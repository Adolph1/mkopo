<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SavingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Savings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="saving-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Saving'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'customer_number',
            'trn_date',
            'amount',
            'fc_period',
            'fc_year',
            'description',
            'payment_method',
            'reference',
            'status',
            // 'maker_id',
            // 'maker_time',
            // 'auth_stat',
            // 'checker_id',
            // 'checker_time',
            'next_pay_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
