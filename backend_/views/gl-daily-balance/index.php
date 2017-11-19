<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GlDailyBalanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Gl Daily Balances');
?>
<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-bank"></i><strong> GL DAILY BALANCES</strong></h3>
    </div>

</div>
<hr>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'trn_date',
            'gl_code',
            'opening_balance',
            'dr_turn',
            'cr_turn',
            'closing_balance',

            //['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
           'clientOptions' => [
               "lengthMenu"=> [[20,-1], [20,Yii::t('app',"All")]],
               "info"=>true,
               "responsive"=>true,
               "dom"=> 'lfTrtip',
               "tableTools"=>[
                   "aButtons"=> [
                       /*[
                           "sExtends"=> "copy",
                           "sButtonText"=> Yii::t('app',"Copy to clipboard")
                       ],[
                           "sExtends"=> "csv",
                           "sButtonText"=> Yii::t('app',"Save to CSV")
                       ],*/
                       [
                           "sExtends"=> "xls",
                           "oSelectorOpts"=> ["page"=> 'current']
                       ],[
                           "sExtends"=> "pdf",
                           "sButtonText"=> Yii::t('app',"Save to PDF")
                       ],[
                           "sExtends"=> "print",
                           "sButtonText"=> Yii::t('app',"Print")
                       ],
                   ]
               ]
           ],
    ]); ?>
    </div>
</div>
