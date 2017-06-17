<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TransactionCode */

$this->title = 'Create Transaction Code';
$this->params['breadcrumbs'][] = ['label' => 'Transaction Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-code-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
