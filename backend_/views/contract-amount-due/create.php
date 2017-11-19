<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ContractAmountDue */

$this->title = 'Create Contract Amount Due';
$this->params['breadcrumbs'][] = ['label' => 'Contract Amount Dues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-amount-due-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
