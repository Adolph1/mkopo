<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContractBalanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contract Balances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-balance-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Contract Balance', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'contract_ref_number',
            'contract_amount',
            'contract_outstanding',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
