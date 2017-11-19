<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SystemDate */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'System Date',
]) . $model->id;
?>

<div class="system-date-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
