<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model backend\models\GeneralLedger */

$this->title = $model->gl_description;
?>
<div class="row">
    <div class="col-md-8">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-th"></i><strong> GL ACCOUNT DETAILS</strong></h3>
    </div>
    <div class="col-md-4 text-center">
        <?=  Html::a('Add Account', ['create'], ['class' => 'btn btn-default text-green']) ?>
        <?=  Html::a('List Accounts', ['index'], ['class' => 'btn btn-default text-green']) ?>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-3">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'gl_code',
            'gl_description',
            'glCategory.category_name',

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
                'header'=>'Gl Parent',
                'attribute'=>'parent_gl',
                'value'=>function ($model){
                if($model->parent_gl==""){
                    return "";
                }else {
                    return $model->parentID->gl_description;
                }
                },
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
            'record_status',
            'maker_id',
            'maker_stamptime',
            'auth_stat',
            'checker_id',
            'checker_stamptime',
            //'mod_no',
        ],
    ]) ?>

    </div>
    <div class="col-md-9">
        <?php

        echo TabsX::widget([
            'position' => TabsX::POS_ABOVE,
            'align' => TabsX::ALIGN_LEFT,
            'items' => [
                [
                    'label' => 'Transactions',
                    'content' => $this->render('transactions',['model'=>$model,]),
                    //'active' => $model->status==1,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['style' => 'background:#ccc'],

                ],
                [
                    'label' => 'Daily Balances',
                    'content' => $this->render('daily_balances',['model'=>$model]),
                    //'active' => $model->status==1,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['style' => 'background:#ccc'],

                ],


            ],
        ]);
        ?>
        <div class="col-md-1"></div>
    </div>
</div>
