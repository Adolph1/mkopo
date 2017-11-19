<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\HistoryEntry */

$this->title = 'Create History Entry';
$this->params['breadcrumbs'][] = ['label' => 'History Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-entry-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
