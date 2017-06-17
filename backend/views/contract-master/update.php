<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ContractMaster */

$this->title = 'Update Contract Master: ' . ' ' . $model->contract_ref_no;
$this->params['breadcrumbs'][] = ['label' => 'Contract Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->contract_ref_no, 'url' => ['view', 'id' => $model->contract_ref_no]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contract-master-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
