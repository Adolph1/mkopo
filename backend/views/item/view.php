<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\SubItemSearch;

/* @var $this yii\web\View */
/* @var $model backend\models\Item */

$this->title = $model->item_name;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12" style="margin-left: 20px">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-folder"></i><strong> BOX DETAILS</strong></h3>
    </div>
</div>
<hr>
<div class="col-md-12 pull-right">
    <div class="btn-group btn-group-justified">
        <?= Html::a(Yii::t('app', '<i class="fa fa-plus text-white"></i> Add new box'), ['create'], ['class' => 'btn btn-primary btn-block']) ?>
        <?= Html::a(Yii::t('app', '<i class="fa fa-search text-white"></i> Advance search'), ['advancesearch'], ['class' => 'btn btn-primary btn-block']) ?>
        <?= Html::a(Yii::t('app', ' <i class="fa fa-eye text-white"></i> View Box List'), ['index'], ['class' => 'btn btn-primary btn-block']) ?>
    </div>
    <hr>
</div>

<div class="item-view">

    <p class="pull-right">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'item_name',
            'year',
            'description:ntext',
            //shelve_id',
            'location.location_name',
            'item_reference',
            'branch.branch_name',
            'department.dept_name',
            //'status',
            'maker_id',
            'maker_time',
        ],
    ]) ?>
    <?php
    $searchModel = new SubItemSearch();
    $dataProvider = $searchModel->searchSubItems($model->id);

    ?>
    <div class="row">
        <div class="col-md-12" style="margin-left: 20px"><h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-book"></i><strong> BOX CONTENTS</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            'description',
            //'item_id',
            'maker_id',
            // 'maker_time',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>
        </div>
</div>
</div>
