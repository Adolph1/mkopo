<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MaturedLoanChargeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Matured Loan Charges');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matured-loan-charge-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Matured Loan Charge'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'contract_ref_number',
            'matured_date',
            'charge_amount',
            'months',
            // 'last_update',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
