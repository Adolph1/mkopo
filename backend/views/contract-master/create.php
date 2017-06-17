<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ContractMaster */

$this->title = 'New Contract';
?>

<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-file-o"></i><strong> NEW LOAN</strong></h3>
    </div>

</div>
<hr>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="btn-group btn-group-justified">

            <?= Html::a(Yii::t('app', '<i class="fa fa-file-o"></i> NEW LOAN'), ['create'], ['class' => 'btn btn-primary']) ?>


            <?= Html::a(Yii::t('app', '<i class="fa fa-th text-black"></i> LOANS CONTRACTS LIST'), ['index'], ['class' => 'btn btn-primary ']) ?>

        </div>
    </div>
</div>
<hr>
<div class="contract-master-create">


    <?= $this->render('_form', [
        'model' => $model,'guarantors'=>$guarantors
    ]) ?>

</div>
