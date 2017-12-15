<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ContractBalance */

$this->title = Yii::t('app', 'Create Contract Balance');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contract Balances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-balance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
