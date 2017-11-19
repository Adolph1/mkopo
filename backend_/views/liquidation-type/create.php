<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LiquidationType */

$this->title = 'Create Liquidation Type';
$this->params['breadcrumbs'][] = ['label' => 'Liquidation Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="liquidation-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
