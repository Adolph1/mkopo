<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\JournalEntry */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Journal Entry',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Journal Entries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="journal-entry-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
