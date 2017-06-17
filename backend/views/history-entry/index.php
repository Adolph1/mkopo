<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\HistoryEntrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'History Entries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-entry-index">

    <h1><?php // Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a('Create History Entry', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'module',
            'trn_ref_no',
            'trn_dt',
            'entry_sr_no',
            // 'ac_no',
            // 'ac_branch',
            // 'event_sr_no',
            // 'event',
            // 'amount',
            // 'amount_tag',
            // 'drcr_ind',
            // 'trn_code',
            // 'related_customer',
            // 'batch_no',
            // 'product',
            // 'value_dt',
            // 'finacial_year',
            // 'period_code',
            // 'maker_id',
            // 'maker_stamptime',
            // 'checker_id',
            // 'auth_stat',
            // 'delete_stat',
            // 'instrument_code',


        ],
    ]); ?>

</div>
