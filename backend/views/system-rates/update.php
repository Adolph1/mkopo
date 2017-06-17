<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SystemRates */

$this->title = 'System Rate: ' . ' ' . $model->rate_name;
$this->params['breadcrumbs'][] = ['label' => 'System Rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rate_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="system-rates-update">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
