<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Customers');
?>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-sitemap text-green"></i><strong> ALL CUSTOMERS REPORT</strong></h3>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-md-12">
        <?= \fedemotta\datatables\DataTables::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'customer_no',
                'first_name',
                'last_name',
                'middle_name',
                [
                    'attribute'=>'gender',
                    'value'=>function ($model){
                        if($model->gender=='M'){
                            return 'Male';
                        }elseif ($model->gender=='F'){
                            return 'Female';
                        }else{
                            return '-';
                        }
                    }
                ],
                'mobile_no1',
                [
                    'attribute'=>'record_stat',
                    'value'=>function ($model){
                        if($model->record_stat=='O'){
                            return 'Active';
                             }elseif ($model->record_stat=='D'){
                            return 'Disabled';
                        }
                    }
                ],



            ],
            'clientOptions' => [
                "lengthMenu"=> [[20,-1], [20,Yii::t('app',"All")]],
                "info"=>true,
                "responsive"=>true,
                "dom"=> 'lfTrtip',
                "tableTools"=>[
                    "aButtons"=> [
                        [
                            "sExtends"=> "copy",
                            "sButtonText"=> Yii::t('app',"Copy to clipboard")
                        ],[
                            "sExtends"=> "csv",
                            "sButtonText"=> Yii::t('app',"Save to CSV")
                        ],
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
