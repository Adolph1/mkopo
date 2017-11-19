<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BusinessRule */

$this->title = Yii::t('app', 'Create Business Rule');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Business Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-rule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
