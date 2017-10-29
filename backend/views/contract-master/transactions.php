<?php
/**
 * Created by PhpStorm.
 * User: adotech
 * Date: 10/26/17
 * Time: 3:18 PM
 */
use yii\helpers\Html;
?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php
        $searchModel = new \backend\models\TodayEntrySearch();
        $dataProvider = $searchModel->searchByReference($model->contract_ref_no,$model->customer_number);
        ?>
        <?= \fedemotta\datatables\DataTables::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'trn_dt',
                'value_dt',
                'amount',
                'ac_no',
                'drcr_ind',
                [
                    'class'=>'yii\grid\ActionColumn',
                    'header'=>'Actions',
                    'template'=>'{view}',
                    'buttons'=>[
                        'view' => function ($url, $model) {
                            if($model->module=='DE'){
                                $path='teller';
                                $id=\backend\models\Teller::getIDByReference($model->trn_ref_no);
                            }elseif($model->module=='LD'){
                                $path='contract-master';
                                $id=$model->trn_ref_no;
                            }
                            $url=[$path.'/view','id' => $id];
                            return Html::a('<span class="fa fa-eye"></span>', $url, [
                                'title' => 'View',
                                'data-toggle'=>'tooltip','data-original-title'=>'Save',
                                'class'=>'btn btn-info',

                            ]);


                        },

                    ]
                ],
            ],
        ]); ?>
    </div>
</div>
