<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SystemDates */

$this->title = 'Create System Dates';
$this->params['breadcrumbs'][] = ['label' => 'System Dates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-dates-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
