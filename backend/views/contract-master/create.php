<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ContractMaster */

$this->title = 'New Contract';
?>
<div class="contract-master-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
