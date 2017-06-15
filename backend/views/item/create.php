<?php

use yii\helpers\Html;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model backend\models\Item */

$this->title = Yii::t('app', 'Create Item');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-9" style="margin-left: 20px">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-folder-o"></i><strong> ADD NEW FILES BOX</strong></h3>
    </div>
</div>
<hr>
<div class="col-md-12 pull-right">
        <div class="btn-group btn-group-justified">
            <?= Html::a(Yii::t('app', '<i class="fa fa-plus text-white"></i> Add new box'), ['create'], ['class' => 'btn btn-primary btn-block']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-search text-white"></i> Advance search'), ['advancesearch'], ['class' => 'btn btn-primary btn-block']) ?>
            <?= Html::a(Yii::t('app', ' <i class="fa fa-eye text-white"></i> View Box List'), ['index'], ['class' => 'btn btn-primary btn-block']) ?>
</div>
    <hr>
</div>


<div class="item-create">

    <legend class="scheduler-border" style="color:#005DAD">Box Details</legend>
    <?= $this->render('_form', [
        'model' => $model,'subitems'=>$subitems
    ]) ?>

</div>
