<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model backend\models\Saccoss */

$this->title = $model->title;
?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <legend class="scheduler-border text-info">About Saccoss</legend>
            <div class="text text-justify">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'background:ntext',
            'address',
        ],
    ]) ?>
            </div>
        </div>
        <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">

        </div>
        <div class="col-lg-3 col-md-8 col-sm-8 col-xs-8">

            <div class="btn-group">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <?php
                    if(!$model->isNewRecord) {

                        echo Html::a(Yii::t('app', '<i class="fa fa-pencil text-blue"></i> Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-default']) ;

                    }

                    ?>
                </ul>
            </div>

        </div>
</div>
