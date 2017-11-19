<?php
/**
 * Created by PhpStorm.
 * User: adotech
 * Date: 10/26/17
 * Time: 5:16 PM
 */
use yii\bootstrap\Html;
?>
<?php
$searchModel = new \backend\models\ContractMasterSearch();
$dataProvider = $searchModel->searchAwaitingDisbursement();
?>
<div class="row">
    <div class="col-md-12">
        <?= \fedemotta\datatables\DataTables::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'contract_ref_no',

                [
                    'header'=>'Customer Name',
                    'value'=>function($model){
                        return \backend\models\Customer::getFullNameByCustomerNumber($model->customer_number);
                    }
                ],
                'customer_number',
                'amount',
                'booking_date',
                'maturity_date',
                'main_component_rate',
                'loan_officer',
                'auth_stat',

                [
                    'class'=>'yii\grid\ActionColumn',
                    'header'=>'Actions',
                    'template'=>'{view}',
                    'buttons'=>[
                        'view' => function ($url, $model) {
                            $url=['view','id' => $model->contract_ref_no];
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
