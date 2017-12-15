<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SystemStage */

$this->title = Yii::t('app', 'Create System Stage');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'System Stages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-stage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
