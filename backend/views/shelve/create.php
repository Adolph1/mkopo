<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Shelve */

$this->title = Yii::t('app', 'Create Shelve');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shelves'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shelve-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
