<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */

$this->title = $model->first_name. ' - '. $model->last_name;
?>
<div class="customer-view">


    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'customer_no',
            'first_name',
            'middle_name',
            'last_name',
            [
                'attribute' => 'identification',
                'value' => $model->identification->name,
            ],
            'identification_number',
            'address',
            'mobile_no1',
            'mobile_no2',
            'email:email',
            [
                'attribute' => 'customer_type_id',
                'value' => $model->customerType->name,
            ],
            'customerCategory.category',
            'branch.branch_name',
            //'photo',
            'mod_no',
            'record_stat',
            'maker_id',
            'maker_time',
        ],
    ]) ?>

</div>
