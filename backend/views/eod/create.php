<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Eod */

$this->title = Yii::t('app', 'Create Eod');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Eods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eod-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
