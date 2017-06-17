<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TodayEntrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Today Entries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="today-entry-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'module',
            'trn_ref_no',
            'trn_dt',
            'entry_sr_no',
             'ac_no',
             'ac_branch',
            //'event_sr_no',
            'event',
             'amount',
             //'amount_tag',
            'drcr_ind',
            // 'trn_code',
            // 'related_customer',
            'batch_number',
            'product',
            'value_dt',
            // 'finacial_year',
            // 'period_code',
            // 'maker_id',
            // 'maker_stamptime',
            // 'checker_id',
            // 'auth_stat',
            // 'delete_stat',
            // 'instrument_code',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>

</div>
