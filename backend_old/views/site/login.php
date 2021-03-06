<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<div class="site-login">




    <div class="row">
        <div class="col-md-4 text-center"></div>
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div style="background: #015EAC;padding: 25px;color: #fff" class="text-center"><strong>Login to PSS</strong></div>
            <div style="padding: 20px">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder'=>'Enter Username'])->label(false) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Enter password'])->label(false) ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <div class="form-group">
                <?= Html::submitButton('<i class="fa fa-key"></i> Login', ['class' => 'btn btn-success btn-block', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-md-2 text-center"><h1>PSS2.0.1</h1></div>
    </div>
</div>
