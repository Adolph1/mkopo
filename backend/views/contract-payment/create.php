<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ContractPayment */

$this->title = Yii::t('app', 'Create Contract Payment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contract Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
