<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SavingType */

$this->title = Yii::t('app', 'Create Saving Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Saving Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="saving-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
