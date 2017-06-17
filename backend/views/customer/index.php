<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Customers');
?>
<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-sitemap"></i><strong> CUSTOMERS LIST</strong></h3>
    </div>

</div>
<hr>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="btn-group btn-group-justified">

            <?= Html::a(Yii::t('app', '<i class="fa fa-user-plus"></i> ADD NEW CUSTOMER'), ['create'], ['class' => 'btn btn-primary']) ?>


            <?= Html::a(Yii::t('app', '<i class="fa fa-th text-black"></i> CUSTOMERS LIST'), ['index'], ['class' => 'btn btn-primary ']) ?>

        </div>
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

            [
                'attribute' => 'photo',
                'format' => 'html',
                'label' => 'Photo',
                'value' => function ($data) {
                    if($data!=null) {
                        return Html::img('uploads/' . $data['photo'],
                            ['width' => '40px', 'height' => '40px', 'class' => 'img-circle']);
                    }
                    else{
                        return Html::img('uploads/avatar.jpeg',
                            ['width' => '40px', 'height' => '40px', 'class' => 'img-circle']);
                    }

                },
            ],
            'customer_no',
            'first_name',
            //'middle_name',
            'last_name',
            //'identification_id',
            //'identification_number',
            //'address',
            'mobile_no1',
            //'mobile_no2',
            // 'email:email',
           [
                'attribute'=>'customer_type_id',
                'value'=>'customerType.name'
           ],
            //'customer_category_id',
            [
                'attribute'=>'branch_id',
                'value'=>'branch.branch_name'
            ],
            // 'photo',
            // 'mod_no',
            // 'record_stat',
            // 'maker_id',
            // 'maker_time',

            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $url=['view','id' => $model->id];
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
