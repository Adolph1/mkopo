<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AccdailyBalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daily Balances');

?>
<?php
$searchModel = new \backend\models\AccbalHistorySearch();
$dataProvider = $searchModel->search($model->cust_ac_no);
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'branch_code',
                'account',
                'bkg_date',
                'acy_opening_balance',
                'acy_closing_balance',
                'acy_dr_tur',
                'acy_cr_tur',
                'available_closing',
                'acy_closing_uncoll',

                //['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
