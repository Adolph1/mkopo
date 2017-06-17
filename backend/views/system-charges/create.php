<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SystemCharges */

$this->title = 'Create System Charges';
$this->params['breadcrumbs'][] = ['label' => 'System Charges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-charges-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
