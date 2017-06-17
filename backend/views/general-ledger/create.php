<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\GeneralLedger */

$this->title = 'General Ledger Form';
$this->params['breadcrumbs'][] = ['label' => 'General Ledgers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="general-ledger-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
