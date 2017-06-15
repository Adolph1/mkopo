<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Branch */

$this->title = $model->branch_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Branches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-eye"></i><strong> <?= strtoupper($model->branch_name);?> BRANCH DETAILS</strong></h3>
    </div>

</div>
<hr>
<div class="row">
    <div class="col-md-12">
<div class="btn-group btn-group-justified">
    <?= Html::a(Yii::t('app', 'Add branch'), ['create'], ['class' => 'btn btn-primary btn-block']) ?>
    <?= Html::a(Yii::t('app', 'Branches list'), ['index'], ['class' => 'btn btn-primary  btn-block']) ?>
    <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
            'method' => 'post',
        ],
    ]) ?>
</div>
</div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //id',
            'branch_name',
            'location',
            [
              'attribute'=>'status',
                'value'=>function($model){
                    if($model->status==0){
                        return 'Disabled';
                    }
                    elseif($model->status==1){
                        return 'Active';
                    }
                }
            ],

        ],
    ]) ?>
    </div>
</div>
