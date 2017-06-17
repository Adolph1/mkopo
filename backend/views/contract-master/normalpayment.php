<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ContractMaster */

$this->title = 'Payment Form';
$this->params['breadcrumbs'][] = ['label' => 'Contracts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-master-create">


    <?= $this->render('_normalpayment', [
        'duemodel' => $duemodel,'id'=>$id,'normalpay'=>$normalpay,
    ]) ?>

</div>
