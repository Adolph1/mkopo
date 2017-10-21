<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model backend\models\Account */

$this->title = $model->cust_ac_no;
?>
<div class="row">
<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">



    <?= Html::a(Yii::t('app', '<i class="fa fa-money text-yellow"></i> NEW ACCOUNT'), ['create'], ['class' => 'btn btn-default text-green']) ?>


    <?= Html::a(Yii::t('app', '<i class="fa fa-th text-yellow"></i> ACCOUNTS LIST'), ['index'], ['class' => 'btn btn-default text-green']) ?>

</div>

</div>
<hr>
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'branch_code',
            'cust_ac_no',
            'ac_desc',
            'cust_no',
            'account_class',
            'ac_stat_no_dr',
            'ac_stat_no_cr',
            'ac_stat_no_block',
            'ac_stat_stop_pay',
            'ac_stat_dormant',
            'acc_open_date',
            'ac_opening_bal',
            'dormancy_date',
            'dormancy_days',
            'acc_status',
            'maker_id',
            'maker_stamptime',
            'checker_id',
            'check_stamptime',
            'mod_no',
            'auth_stat',
        ],
    ]) ?>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <?php

        echo TabsX::widget([
            'position' => TabsX::POS_ABOVE,
            'align' => TabsX::ALIGN_LEFT,
            'items' => [
                [
                    'label' => 'Accounts',
                    //'content' => $this->render('_member_form',['model'=>$model,]),
                    //'active' => $model->status==1,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['style' => 'background:#ccc'],

                ],
                [
                    'label' => 'Savings',
                    //'content' => $this->render('_member_form',['model'=>$model,]),
                    //'active' => $model->status==1,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['style' => 'background:#ccc'],

                ],
                [
                    'label' => 'Loans',
                    //'content' => $this->render('_partner_form',['model'=>$model,]),
                    'visible'=>!$model->isNewRecord,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    //'active' => $model->status==2,
                    'options' => ['id' => 'partner',],

                ],
                [
                    'visible'=>!$model->isNewRecord,
                    'label' => 'Deposits',
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
                    'label' => 'Collateral',
                    //'active' => $model->status==5,
                    //'content' => $this->render('_login',['model'=>$model,'user'=>$user,]),
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['id' => 'user',],

                ],
                [
                    'visible'=>!$model->isNewRecord,
                    'label' => 'Contacts',
                    //'active' => $model->status==6,
                    //'content' => $this->render('_preview',['model'=>$model,'student'=>$student,]),
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['id' => 'preview',],

                ],
                [
                    'visible'=>!$model->isNewRecord,
                    'label' => 'Identifications',
                    //'active' => $model->status==6,
                    //'content' => $this->render('_preview',['model'=>$model,'student'=>$student,]),
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['id' => 'preview',],

                ],
                [
                    'visible'=>!$model->isNewRecord,
                    'label' => 'Business Details',
                    //'active' => $model->status==6,
                    //'content' => $this->render('_preview',['model'=>$model,'student'=>$student,]),
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['id' => 'preview',],

                ],
            ],
        ]);
        ?>
        <div class="col-md-1"></div>
    </div>
</div>
