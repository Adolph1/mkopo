<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Department */

$this->title = $model->dept_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Departments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p style="float: right">
        <?= Html::a(Yii::t('app', 'Add department'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Department list'), ['index'], ['class' => 'btn btn-warning']) ?>
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
           // 'id',
            'dept_name',
            [
              'attribute'=>'branch_id',
                'value'=>$model->branch->branch_name,
            ],
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
           // 'maker_id',
            //'maker_time',
        ],
    ]) ?>

</div>
