<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\EodCycle */

$this->title = Yii::t('app', 'Create Eod Cycle');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Eod Cycles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eod-cycle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
