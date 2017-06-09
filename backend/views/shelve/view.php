<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Shelve */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shelves'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shelve-view">

    <h1 align="center"><span class="text text-primary"><?= Html::encode($this->title) ?></span></h1>

    <p style="float: right">
        <?= Html::a(Yii::t('app', 'Add Shelve'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Shelve list'), ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
                //'id',
            'title',
            'loc_id',
            'max_box_no',
           // 'status',
            //'maker_id',
            //'maker_time',
        ],
    ]) ?>

</div>
