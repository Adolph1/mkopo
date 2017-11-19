<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ContributionType */

$this->title = Yii::t('app', 'Create Contribution Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contribution Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contribution-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
