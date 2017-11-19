<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AccbalHistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Accbal Histories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accbal-history-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Accbal History'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'branch_code',
            'account',
            'bkg_date',
            'acy_opening_balance',
            // 'acy_closing_balance',
            // 'acy_dr_tur',
            // 'acy_cr_tur',
            // 'available_closing',
            // 'acy_closing_uncoll',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
