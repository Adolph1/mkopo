<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransactionCodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaction Codes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-code-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Transaction Code', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'trn_id',
            'trn_code',
            'trn_description',
            'maker_id',
            'maker_stamptime',
            // 'checker_id',
            // 'checker_stamptime',
            // 'record_stat',
            // 'mod_no',
            // 'auth_stat',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>

</div>
