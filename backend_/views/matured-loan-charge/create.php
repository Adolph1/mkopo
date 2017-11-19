<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MaturedLoanCharge */

$this->title = Yii::t('app', 'Create Matured Loan Charge');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Matured Loan Charges'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matured-loan-charge-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
