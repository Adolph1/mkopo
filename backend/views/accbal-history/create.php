<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AccbalHistory */

$this->title = Yii::t('app', 'Create Accbal History');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accbal Histories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accbal-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
