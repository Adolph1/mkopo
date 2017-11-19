<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AccountClassSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Account Classes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-class-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Account Class'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'acc_class',
            'description',
            'dormancy',
            'record_status',
            'maker_id',
            // 'maker_stamptime',
            // 'checker_id',
            // 'check_stamptime',
            // 'auth_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
