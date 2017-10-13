<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Account */

$this->title = $model->cust_ac_no;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accounts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->cust_ac_no], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->cust_ac_no], [
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
            'branch_code',
            'cust_ac_no',
            'ac_desc',
            'cust_no',
            'account_class',
            'ac_stat_no_dr',
            'ac_stat_no_cr',
            'ac_stat_no_block',
            'ac_stat_stop_pay',
            'ac_stat_dormant',
            'acc_open_date',
            'ac_opening_bal',
            'dormancy_date',
            'dormancy_days',
            'acc_status',
            'maker_id',
            'maker_stamptime',
            'checker_id',
            'check_stamptime',
            'mod_no',
            'auth_stat',
        ],
    ]) ?>

</div>
