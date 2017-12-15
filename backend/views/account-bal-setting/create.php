<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AccountBalSetting */

$this->title = Yii::t('app', 'Create Account Bal Setting');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Account Bal Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-bal-setting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
