<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\tabs\TabsX;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContractMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Loans contracts';
?>

<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-th"></i><strong> LOANS CONTRACTS LIST</strong></h3>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-right">
            <?= Html::a(Yii::t('app', '<i class="fa fa-file-o"></i> NEW LOAN'), ['create'], ['class' => 'btn btn-default text-green']) ?>

    </div>

</div>
<hr>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php

        echo TabsX::widget([
            'position' => TabsX::POS_ABOVE,
            'align' => TabsX::ALIGN_LEFT,
            'items' => [
                [
                    'label' => 'Active Loans',
                    'content' => $this->render('loans',['dataProvider' => $dataProvider,]),
                    //'active' => $model->status==1,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['style' => 'background:#fff'],

                ],
                [
                    'label' => 'Pending Approval ('.\backend\models\ContractMaster::getPendingCount().')',
                    'content' => $this->render('pendings'),
                    //'active' => $model->status==1,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['style' => 'background:#fff'],

                ],
                [
                    'label' => 'Awaiting Disbursement',
                   // 'content' => $this->render('guarantors',['model'=>$model]),
                    //'active' => $model->status==1,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['style' => 'background:#fff'],

                ],
                [
                    'label' => 'Written Off Loans',
                    // 'content' => $this->render('guarantors',['model'=>$model]),
                    //'active' => $model->status==1,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['style' => 'background:#fff'],

                ],
                [
                    'label' => 'Closed Loans',
                    // 'content' => $this->render('guarantors',['model'=>$model]),
                    //'active' => $model->status==1,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['style' => 'background:#fff'],

                ],


            ],
        ]);
        ?>

    </div>
</div>
