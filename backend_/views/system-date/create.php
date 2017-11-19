<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SystemDate */

$this->title = Yii::t('app', 'System Date');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'System Dates'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-date-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
