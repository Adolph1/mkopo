<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContractAmountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contract Amounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-amount-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Contract Amount', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'contract_ref_number',
            'due_date',
            'amount_due',
            'account_due',
            // 'customer_number',
             'amount_settled',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
