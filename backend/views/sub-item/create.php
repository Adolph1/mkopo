<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SubItem */

$this->title = Yii::t('app', 'Create Sub Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sub Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
