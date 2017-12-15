<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ReferenceIndex */

$this->title = 'Update Reference Index: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reference Indices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reference-index-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
