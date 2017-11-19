<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SystemRatesSeacrh */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'System Rates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-rates-index">

    <h1><?php // Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a('Create System Rates', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           //'id',
            'rate_name',
            'status',
            'maker_id',
            'maker_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
