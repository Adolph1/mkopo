<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ReferenceIndex */

$this->title = 'Create Reference Index';
$this->params['breadcrumbs'][] = ['label' => 'Reference Indices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reference-index-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
