<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ContractAmountPaid */

$this->title = 'Create Contract Amount Paid';
$this->params['breadcrumbs'][] = ['label' => 'Contract Amount Paids', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-amount-paid-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
