<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Group */

$this->title = $model->id;
?>
 <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
<div class="group-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'group_name',
            'status',
        ],
    ]) ?>
<br/>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <legend class="scheduler-border" style="color:#005DAD">Add Contact:</legend>
        <?php
        Modal::begin([
            'header' => '<h2>Add Contact to group</h2>',
            'toggleButton' => ['label' => '<i class="fa fa-user-plus"></i> Add Contact', 'class' => 'btn btn-warning enabled'],
            'size' => Modal::SIZE_LARGE,
            'options' => ['class' => 'slide'],
        ]);
        ?>

        <?php $form = ActiveForm::begin(['action'=>['view','id'=>$model->id]]); ?>


        <?= $form->field($client, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($client, 'phone_number')->textInput(['maxlength' => true]) ?>

         <?= $form->field($client, 'location')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton($client->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $client->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'three']) ?>
        </div>




        <?php ActiveForm::end(); ?>


        <?php

        Modal::end();
        ?>
    
    
    </div>
</div>
<br/>

 <?php
        $searchModel = new \backend\models\GroupContactSearch();
        $dataProvider = $searchModel->searchByGroupID($model->id);
    ?>
     <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'group_id',
            'client_id',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>
</div>
