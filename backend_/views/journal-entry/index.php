<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\JournalEntrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Journal Entries');
$this->params['breadcrumbs'][] = $this->title;
?>



<?php Modal::begin([
    'id'=>'new-entry',
    'header' => '<h4 class="modal-title text-center">Journal Entry Form</h4>',
    'size'=>'modal-md',
    'toggleButton' => ['label' => 'New Entry','class'=>['btn btn-primary']],
    'class'=>['btn btn-primary'],

]); ?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'trn_dt')->widget(DatePicker::ClassName(),
            [
                //'name' => 'purchase_date',
                //'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Enter booking date', 'value'=>date('Y-m-d'),],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'autoclose' => true,
                    'todayHighlight' => true,

                ]
            ]);?>
    </div>
    <div class="col-md-6" id="ref-no">
        <?= $form->field($model, 'trn_ref_no')->textInput(['readonly'=>'readonly']) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-12 col-xs-12">
        <?= $form->field($model, 'debit_account')->dropDownList(\backend\models\GeneralLedger::getAll(),['prompt' => '--Select--']) ?>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
        <?= $form->field($model, 'credit_account')->dropDownList(['prompt' => '--Select--']) ?>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
        <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>
    </div>

</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?= $form->field($model, 'description')->textInput() ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-right">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>


<?php Modal::end(); ?>

<div class="journal-entry-index">

    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',

            'trn_dt',
            'description',
            'amount',
            'debit_account',
            'credit_account',

            'trn_ref_no',

            // 'maker_id',
            // 'maker_time',
             'auth_stat',
            // 'trn_status',
            // 'checker_id',
            // 'checker_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

