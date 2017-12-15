<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AccdailyBalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Accdaily Bals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accdaily-bal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Accdaily Bal'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'branch_code',
            'account',
            'value_date',
            'available_balance',
            // 'Debit_tur',
            // 'Cedit_tur',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
