<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ContractNormalRepayment */

$this->title = 'Create Contract Normal Repayment';
$this->params['breadcrumbs'][] = ['label' => 'Contract Normal Repayments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-normal-repayment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
