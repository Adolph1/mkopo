<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
//use yii\grid\GridView;
use kartik\grid\GridView;
use dosamigos\editable\Editable;

/* @var $this yii\web\View */
/* @var $model backend\models\ContractMaster */

$this->title = $model->contract_ref_no;
$this->params['breadcrumbs'][] = ['label' => 'Contract Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-master-view">


    <div class="col-md-12">

        <?php
        if($model->contract_status=='Active') {
            ?>
            <div style="margin-bottom: 5px"><?= Html::a('Liquidate', ['normalpayment', 'id' => $model->contract_ref_no], ['class' => 'btn btn-warning']) ?></div>
            <?php
        }
        ?>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <?= Yii::t('app', 'Loan Details'); ?>



            </div>
            <div class="panel-body" style="font-size: 12px">

                <div class="row">

                    <div class="col-md-7"><b>Reference:</b> <?= $model->contract_ref_no;?></div>
                    <div class="col-md-5"><b>Booking Date:</b> <?= $model->booking_date;?> | <b>Maturity Date:</b> <?= $model->maturity_date;?></div>

                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-7">
                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-5">Contract Product:</div>
                            <div class="col-md-7"> <?= $model->product;?></div>

                        </div>
                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-5">Contract Amount:</div>
                            <div class="col-md-7"> <?= $modelbal->contract_amount;?></div>
                        </div>
                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-5">Payment Type:</div>
                            <div class="col-md-7"> <?= $model->payment_method;?></div>
                        </div>
                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-5">Number of Installment:</div>
                            <div class="col-md-7"> <?= $model->frequency;?></div>
                        </div>
                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-5">Rate:</div>
                            <div class="col-md-7"> <?= $model->main_component_rate;?>%</div>
                        </div>
                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-5">Status:</div>
                            <div class="col-md-7"> <?= $model->contract_status;?></div>
                        </div>
                    </div>
                    <div class="col-md-5">

                        <div class="row">
                            <div class="col-md-12">
                                <b>Customer Details</b>
                            </div>
                        </div>
                        <?php
                        $customerdetails=$model->getCustomer($model->customer_number);
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row" style="margin-bottom: 5px;margin-top: 5px">
                                    <div class="col-md-12 text-primary"><i class="fa fa-user fa-2x"></i> <?= $customerdetails->customer_name;?></div>

                                </div>
                                <div class="row" style="margin-bottom: 5px">
                                    <div class="col-md-12 text-primary"><i class="fa fa-credit-card fa-2x" aria-hidden="true"></i> <?= $model->customer_number;?></div>
                                </div>
                                <div class="row" style="margin-bottom: 5px">
                                    <div class="col-md-12 text-primary"><i class="fa fa-home fa-2x" aria-hidden="true"></i> <?= $customerdetails->customer_address;?></div>
                                </div>
                                <div class="row" style="margin-bottom: 5px">
                                    <div class="col-md-12 text-primary"><i class="fa fa-mobile-phone fa-2x" aria-hidden="true"></i> <?= $customerdetails->mobile_no_1;?></div>
                                </div>
                                <div class="row" style="margin-bottom: 5px">
                                    <div class="col-md-12 text-primary"><i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i> <?= $customerdetails->email;?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php
                                if($customerdetails->photo!="")
                                {
                                    ?>
                                    <?= Html::img(Yii::$app->request->baseUrl.'/Uploads/'.$customerdetails->photo, ['alt'=>'some', 'class'=>'thing','style'=>'width:180px;height:150px;border:5px solid #bbb;']);?>

                                    <?php
                                }
                                else
                                {
                                ?>
                                <?= Html::img(Yii::$app->request->baseUrl.'/Uploads/avarta.png', ['alt'=>'some', 'class'=>'thing','style'=>'width:180px;height:150px;border:5px solid #bbb;']);?>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="text-primary"> <b>Payment Details</b></div>
            <?php
            $gridColumns = [
                ['class' => 'kartik\grid\SerialColumn'],
                'contract_ref_no',
                'branch',
                //'product',
                //'product_type',
               // 'module',
                //'payment_method',
                //'customer_number',
                'amount',
                'booking_date',
                'value_date',
                'maturity_date',
                'main_component',
                'settle_account',
                'contract_status',
                //'main_component_rate',
                //'payment_date',
                //'frequency',
                //'maker_id',
                //'maker_stamptime',
                //'checker_id',
                //'checker_stamptime',
                //'seq_number',

            ];
            ?>

            <?= GridView::widget([
                'dataProvider' => $datadues,

                //'filterModel' => $searchModel,
                'columns' =>  $gridColumns,
                'responsive'=>true,
                'hover'=>true,



                // ['class' => 'yii\grid\SerialColumn'],

            ]); ?>
            <hr/>





        </div>
