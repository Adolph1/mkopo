<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountClass */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Account Class',
]) . $model->acc_class;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Account Classes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->acc_class, 'url' => ['view', 'id' => $model->acc_class]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="account-class-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
