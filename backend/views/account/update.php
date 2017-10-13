<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Account */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Account',
]) . $model->cust_ac_no;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accounts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cust_ac_no, 'url' => ['view', 'id' => $model->cust_ac_no]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="account-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
