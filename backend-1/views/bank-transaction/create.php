<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BankTransaction */

$this->title = Yii::t('app', 'Create Bank Transaction');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bank Transactions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-transaction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
