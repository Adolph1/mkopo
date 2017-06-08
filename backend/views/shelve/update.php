<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Shelve */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Shelve',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shelves'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="shelve-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
