<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TransactionCode */

$this->title = 'Update Transaction Code: ' . ' ' . $model->trn_id;
$this->params['breadcrumbs'][] = ['label' => 'Transaction Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->trn_id, 'url' => ['view', 'id' => $model->trn_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transaction-code-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
