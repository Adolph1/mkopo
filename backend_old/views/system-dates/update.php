<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SystemDates */

$this->title = 'Update System Dates: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'System Dates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="system-dates-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
