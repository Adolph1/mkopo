<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ContractMaster */

$this->title = 'New Contract';
?>

<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-file-o"></i><strong> NEW LOAN</strong></h3>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-right">

            <?= Html::a(Yii::t('app', '<i class="fa fa-th text-green"></i> LOANS LIST'), ['index'], ['class' => 'btn btn-default text-green']) ?>

    </div>

</div>
<hr>
<div class="contract-master-create">
    <?= $this->render('_form', [
        'model' => $model,'guarantors'=>$guarantors
    ]) ?>

</div>
