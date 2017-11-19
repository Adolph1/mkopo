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
        //$searchModel = new \backend\models\TodayEntrySearch();
       // $dataProvider = $searchModel->searchByReference($model->contract_ref_no,$model->customer_number);

        $searchModel = new \backend\models\ContractPaymentSearch();
        $dataProvider = $searchModel->searchByReference($model->contract_ref_no);
        ?>
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'trn_dt',
                [
                  'attribute'=>'transaction_type',
                    'value'=>function ($model){
                    if($model->transaction_type==\backend\models\ContractPayment::DISBURSEMENT){

                        return 'Disbursement';

                    }elseif ($model->transaction_type==\backend\models\ContractPayment::REPAYMENT){

                        return 'Repayment';

                    }elseif ($model->transaction_type==\backend\models\ContractPayment::REVERSAL){

                        return 'Reversal';
                    }
                    }
                ],
                'debit',
                'credit',
                'balance',
        [
        'attribute'=>'description',
        'value'=>function ($model){
            if($model->description=="")
            {
                return "";
            }else{
                return $model->description;
            }

        }
        ],

            ],
        ]); ?>
    </div>
</div>
