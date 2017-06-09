<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Shelve */

$this->title = Yii::t('app', 'Shelve Details');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shelves'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <div class="col-md-12" style="margin-left: 20px">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-folder-o"></i><strong> ADD NEW SHELVE</strong></h3>
    </div>
</div>
<hr>

<div class="shelve-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
