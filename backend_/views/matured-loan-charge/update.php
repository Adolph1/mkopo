<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MaturedLoanCharge */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Matured Loan Charge',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Matured Loan Charges'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="matured-loan-charge-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
