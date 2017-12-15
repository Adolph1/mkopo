<?php
/**
 * Created by PhpStorm.
 * User: adotech
 * Date: 10/26/17
 * Time: 5:01 PM
 */
use yii\helpers\Html;
?>
<?php
$searchModel = new \backend\models\ContractMasterSearch();
$dataProvider = $searchModel->searchByCustomerAccount($model->cust_ac_no);
?>
<div class="row">
    <div class="col-md-12">
        <?= \fedemotta\datatables\DataTables::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'contract_ref_no',
                'amount',
                'booking_date',
                'maturity_date',
                'contract_status',
                [
                    'class'=>'yii\grid\ActionColumn',
                    'header'=>'Actions',
                    'template'=>'{view}',
                    'buttons'=>[
                        'view' => function ($url, $model) {
                            $url=['contract-master/view','id' => $model->contract_ref_no];
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
