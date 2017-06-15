<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CustomerIdentification */

$this->title = Yii::t('app', 'Create Customer Identification');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customer Identifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-identification-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
