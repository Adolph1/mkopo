<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ContractEvents */

$this->title = 'Create Contract Events';
$this->params['breadcrumbs'][] = ['label' => 'Contract Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-events-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
