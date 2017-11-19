<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LiquidationType */

$this->title = 'Liquidation Type: ' . ' ' . $model->type;
$this->params['breadcrumbs'][] = ['label' => 'Liquidation Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->type, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="liquidation-type-update">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
