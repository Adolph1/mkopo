<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\GroupContact */

$this->title = Yii::t('app', 'Create Group Contact');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Group Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-contact-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
