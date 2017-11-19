<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AccdailyBalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Available Balance');

?>
<?php
$searchModel = new \backend\models\AccdailyBalSearch();
$dataProvider = $searchModel->searchBalance($model->cust_ac_no);
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'value_date',
            'branch_code',
            'account',

            'available_balance',
            'Debit_tur',
            'Cedit_tur',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>

</div>
