<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Item */

$this->title = $model->item_name;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="row">
    <div class="col-md-12" style="margin-left: 20px">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-folder-o"></i><strong> UPDATE FILES BOX: <?= Html::encode(strtoupper($this->title)) ?></strong></h3>
    </div>
</div>
<hr>
<div class="item-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
