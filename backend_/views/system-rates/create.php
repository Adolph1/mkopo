<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SystemRates */

$this->title = 'Create System Rates';
$this->params['breadcrumbs'][] = ['label' => 'System Rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-rates-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
