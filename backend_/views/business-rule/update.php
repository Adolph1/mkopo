<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BusinessRule */

$this->title = Yii::t('app', 'Update Business Rule');
?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-lock"></i><strong> UPDATE BUSINESS RULE</strong></h3>
    </div>

</div>
<hr>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
