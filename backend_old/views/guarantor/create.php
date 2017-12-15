<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Guarantor */

$this->title = Yii::t('app', 'Create Guarantor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Guarantors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guarantor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
