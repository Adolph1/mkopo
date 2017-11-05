<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Student */

$this->title = Yii::t('app', 'New Student');

?>
<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-user text-yellow"></i><strong> NEW STUDENT</strong></h3>
    </div>

</div>
<hr>
<div class="row">
    <div class="col-md-12">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
