<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Client */

$this->title = Yii::t('app', 'Create Client');
?>
<div class="row">
    <div class="col-md-8">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-user text-yellow"></i><strong> Clients </strong></h3>
    </div>
    <div class="col-md-4">
        <?= Html::a(Yii::t('app', 'Clients List'), ['index'], ['class' => 'btn btn-info btn-block']) ?>
    </div>
</div>
<hr>
<div class="client-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
