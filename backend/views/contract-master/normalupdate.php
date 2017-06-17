<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ContractMaster */

$this->title = 'Update Contract Master: ' . ' ' . $duemodel->contract_ref_number;
$this->params['breadcrumbs'][] = ['label' => 'Contract Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $duemodel->contract_ref_number, 'url' => ['view', 'id' => $duemodel->contract_ref_number]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contract-master-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_normalpayment', [
        'duemodel' => $duemodel,'id'=>$id,'normalpay'=>$normalpay,
    ]) ?>

</div>
