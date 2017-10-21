<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model backend\models\Saccoss */

$this->title = $model->title;
?>
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <legend class="scheduler-border text-info">Saccoss Details</legend>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'background:ntext',
            'address',
        ],
    ]) ?>
        </div>
        <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
        <?php

        echo TabsX::widget([
            'position' => TabsX::POS_ABOVE,
            'align' => TabsX::ALIGN_LEFT,
            'items' => [
                [
                    'label' => 'Assets',
                    //'content' => $this->render('_accounts',['model'=>$model,]),
                    //'active' => $model->status==1,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['style' => 'background:#ccc'],

                ],
                [
                    'label' => 'Bank Accounts',
                    //'content' => $this->render('_savings',['model'=>$model]),
                    //'active' => $model->status==1,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['style' => 'background:#ccc'],

                ],
                [
                    'label' => 'Loans',
                    //'content' => $this->render('loans',['model'=>$model,]),
                    'visible'=>!$model->isNewRecord,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    //'active' => $model->status==2,
                    'options' => ['id' => 'partner',],

                ],
                [
                    'label' => 'Deposits',
                    //'content' => $this->render('loans',['model'=>$model,]),
                    'visible'=>!$model->isNewRecord,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    //'active' => $model->status==2,
                    'options' => ['id' => 'partner',],

                ],
                [
                    'visible'=>!$model->isNewRecord,
                    'label' => 'Investments',
                    //'content' => $this->render('_student',['student'=>$student,'model'=>$model]),
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    //'active' => $model->status==3,
                    'options' => ['id' => 'student','class'=>'disabled'],

                ],
                [
                    'visible'=>!$model->isNewRecord,
                    'label' => 'Shares',
                    //'content' => $this->render('_regfee',['regfee'=>$regfee,'model'=>$model]),
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    //'active' => $model->status==4,
                    'options' => ['id' => 'regfee','class'=>'disabled'],

                ],
                [
                    'visible'=>!$model->isNewRecord,
                    'label' => 'Shareholders',
                    //'active' => $model->status==5,
                    //'content' => $this->render('_login',['model'=>$model,'user'=>$user,]),
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['id' => 'user',],

                ],
                [
                    'visible'=>!$model->isNewRecord,
                    'label' => 'Business Rules',
                    //'active' => $model->status==6,
                    'content' => $this->render('_business_rule',['model'=>$model,]),
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['id' => 'preview',],

                ],
            ],
        ]);
        ?>
        </div>
        <div class="col-lg-3 col-md-8 col-sm-8 col-xs-8">

            <div class="btn-group">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <?php
                    if(!$model->isNewRecord) {

                        echo Html::a(Yii::t('app', '<i class="fa fa-pencil text-blue"></i> Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-default']) ;

                    }

                    ?>
                </ul>
            </div>

        </div>
</div>
