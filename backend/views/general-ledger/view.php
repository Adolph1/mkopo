<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\GeneralLedger */

$this->title = $model->gl_description;
$this->params['breadcrumbs'][] = ['label' => 'General Ledgers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="general-ledger-view">

    <h1><?php // Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->gl_code], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->gl_code], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'gl_code',
            'gl_description',
            'parent_gl',
            'leaf',
            'type',
            'customer',
            'category',
            'posting_restriction',
            'record_status',
            'maker_id',
            'maker_stamptime',
            'checker_id',
            'checker_stamptime',
            'mod_no',
        ],
    ]) ?>

</div>
