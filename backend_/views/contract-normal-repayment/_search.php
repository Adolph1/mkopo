<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ContractNormalRepaymentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-normal-repayment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?= Yii::t('app', 'Search Form'); ?>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'contract_ref_number') ?>

                <div class="form-group">
                    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                    <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
