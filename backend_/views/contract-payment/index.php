<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContractPaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Contract Payments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-payment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Contract Payment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'trn_dt',
            'transaction_type',
            'contract_ref_number',
            'debit',
            // 'credit',
            // 'balance',
            // 'description',
            // 'maker_id',
            // 'maker_time',
            // 'auth_stat',
            // 'checker_id',
            // 'checker_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
