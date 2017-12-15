<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AccdailyBal */

$this->title = Yii::t('app', 'Create Accdaily Bal');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accdaily Bals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accdaily-bal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
