<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GeneralLedgerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'General Ledgers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="general-ledger-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=  Html::a('Add GL', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'gl_code',
            'gl_description',
            'parent_gl',
            [
                'attribute' =>'posting_restriction',
                'value' => function ($searchModel) {
                    if ($searchModel->posting_restriction=='1')
                    {
                        return 'Direct Posting';
                    }
                    else
                    {
                        return 'Indirect Posting';
                    }
                }],

            [
                'attribute' => 'glType',
                'value' => 'glType.name'
            ],
            [
                'attribute' =>'customer',
                'value' => function ($searchModel) {
                    if ($searchModel->customer=='1')
                    {
                        return 'Customer GL';
                    }
                    else
                    {
                        return 'Internal GL';
                    }
                }],
            [
                'attribute' => 'glCategory',
                'value' => 'glCategory.category_name'
            ],
            [
            'attribute' =>'leaf',
            'value' => function ($searchModel) {
                if ($searchModel->leaf=='1')
                {
                    return 'Leaf GL';
                }
                else
                {
                    return 'Node GL';
                }
            }],
            //'record_status',
            //'maker_id',
            //'maker_stamptime',
            // 'checker_id',
            // 'checker_stamptime',
            // 'mod_no',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Actions'
            ],

        ],
    ]); ?>

</div>
