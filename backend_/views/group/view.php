<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Group */

$this->title = $model->group_name;
?>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
        <h3  style="color: #003b4c;font-family: Tahoma"><i class="fa fa-th text-green"></i><strong> GROUP DETAIL</strong></h3>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-8 col-xs-8">
        <?= Html::a(Yii::t('app', '<i class="fa fa-plus text-yellow"></i> ADD NEW GROUP'), ['create'], ['class' => 'btn btn-default text-green']) ?>

        <?= Html::a(Yii::t('app', '<i class="fa fa-th text-yellow"></i> GROUPS LIST'), ['index'], ['class' => 'btn btn-default text-green']) ?>

    </div>
</div>
<hr/>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'group_name',
            'group_number',
            'branch.branch_name',
            'location',
            [
                'attribute'=>'loan_officer',
                'value'=> function ($model){
                    if($model->loan_officer!=null){
                        return \backend\models\Employee::getFullNameByEmpID($model->loan_officer);
                    }else{
                        return ' ';
                    }
                }
            ],
            'registration_date',
            'auth_status',
            'status',
            'maker_id',
            'maker_time',
            'checker_id',
            'checker_time',
        ],
    ]) ?>
    </div>

</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
    <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' =>yii::$app->User->can('LoanOfficer') ? 'btn btn-primary enabled':'btn btn-primary disabled']) ?>
    <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
        'class' =>yii::$app->User->can('LoanOfficer') ? 'btn btn-danger enabled':'btn btn-danger disabled',
        'data' => [
            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
            'method' => 'post',
        ],
    ]) ?>

    <?= Html::a(Yii::t('app', '<i class="fa fa-check text-green"></i> Approve'), ['approve', 'id' => $model->id], [
        'class' => yii::$app->User->can('LoanManager') && $model->auth_status=='U' ? 'btn btn-warning enabled':'btn btn-warning disabled',
        'data' => [
            'confirm' => Yii::t('app', 'Are you sure you want to approve this group?'),
            'method' => 'post',
        ],
    ]) ?>
    </div>
</div>
