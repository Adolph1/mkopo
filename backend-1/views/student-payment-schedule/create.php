<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\StudentPaymentSchedule */

$this->title = Yii::t('app', 'Create Student Payment Schedule');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Student Payment Schedules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-payment-schedule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
