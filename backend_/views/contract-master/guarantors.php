<?php
/**
 * Created by PhpStorm.
 * User: adotech
 * Date: 10/26/17
 * Time: 1:14 PM
 */
?>

<div class="row">
    <div class="col-md-12">
        <?php
        $searchModel = new \backend\models\GuarantorSearch();
        $dataProvider = $searchModel->searchByReference($model->contract_ref_no);
        ?>
        <?= \fedemotta\datatables\DataTables::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                'name',
                'phone_number',
                [
                    'attribute'=>'identification',
                    'value'=>'identificationID.name',
                ],

                'identification_number',
                //'related_customer',
                // 'maker_id',
                // 'maker_time',

                //['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
