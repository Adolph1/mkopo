<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use backend\models\Accrole;
use backend\models\GeneralLedger;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->product_id;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->product_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->product_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'product_id',
            'product_descption',
            //'product_type',
            //'product_module',
            'product_remarks',
            'product_start_date',
            'product_end_date',
            'product_group',
            'maker_id',
            'maker_stamptime',
            'checker_id',
            'checker_stamptime',
            'record_stat',
            'mod_no',
        ],
    ]) ?>

    <?php
    //create account of the customer
    Modal::begin([
        'header' => '<h2>Accounting Roles</h2>',
        'toggleButton' => ['label' => 'Manage Roles','class' => 'btn btn-danger'],
        'size' => Modal::SIZE_LARGE,
        'options' => ['class'=>'slide'],
    ]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataRoles,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'account_role',
            'role_type',
            'status',
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute' => 'role_type',
                'refreshGrid' => true,
                //'format'=>['decimal', 2],
                'editableOptions'=> [
                    'header'=>'Name',
                    'size'=>'md',
                    'formOptions' => ['action' => ['cart/editcart']],
                    'asPopover' => false,
                    // 'inputType'=>\kartik\editable\Editable::INPUT_SPIN,
                    'options'=>[
                        'pluginOptions'=>['min'=>0, 'max'=>5000]
                    ]
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute' => 'account_head',
                'refreshGrid' => true,
                //'format'=>['decimal', 2],
                'editableOptions'=> [
                    'header'=>'Name',
                    'size'=>'md',
                    'formOptions' => ['action' => ['cart/editcart']],
                    'asPopover' => true,
                    // 'inputType'=>\kartik\editable\Editable::INPUT_SPIN,
                    'options'=>[
                        'pluginOptions'=>['min'=>0, 'max'=>5000]
                    ]
                ],
            ],




            // 'description',

            [
                'class' => 'yii\grid\ActionColumn','header'=>'Actions',
                'template' => '{view}{delete}{edit}',
                'buttons' => [
                    'delete' => function ($url, $dataRoles) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,[
                            'title' => Yii::t('app', 'Delete'),
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]


                        );
                    },

                ],
                'urlCreator' => function ($action, $dataRoles, $key, $index) {
                    if ($action === 'delete') {

                        $url=Yii::$app->urlManager->createUrl(['product-accrole/delete', 'id' => $dataRoles->id]);
                        return $url;

                    }
                    elseif ($action === 'view') {

                        $url=Yii::$app->urlManager->createUrl(['product-accrole/view', 'id' => $dataRoles->id]);
                        return $url;

                    }
                }

            ],

        ],

    ]);
    ?>
    <?php

    Modal::end();
    ?>
    <?php
    Modal::begin([
    'header' => '<h2>New Role Form</h2>',
    'toggleButton' => ['label' => 'New Role','class' => 'btn btn-success'],
    'size' => Modal::SIZE_LARGE,
    'options' => ['class'=>'slide'],
    ]);
    ?>
    <div class="product-accrole-form">

        <?php $form = ActiveForm::begin([
            'action' => ['product-accrole/create'],
        ]); ?>
        <?php
        $accrole=Accrole::find()->all();

        $listaccroles=ArrayHelper::map($accrole,'role_code','role_description');
        $form->field($modelaccrole, 'account_role')->dropDownList(
            $listaccroles,
            ['prompt'=>'Select...']);
        $gls=GeneralLedger::find()->all();

        $listgls=ArrayHelper::map($gls,'gl_code','gl_description');
        $form->field($modelaccrole, 'account_head')->dropDownList(
            $listgls,
            ['prompt'=>'Select...']);

        ?>

        <?= $form->field($modelaccrole, 'account_role')->dropDownList($listaccroles, ['prompt'=>'--Select--']) ?>

        <?= $form->field($modelaccrole, 'product_code')->textInput(['maxlength' => 200,'value'=>$model->product_id]) ?>

        <?= $form->field($modelaccrole, 'role_type')->textInput(['maxlength' => 200]) ?>

        <?= $form->field($modelaccrole, 'status')->textInput(['maxlength' => 200]) ?>

        <?= $form->field($modelaccrole, 'account_head')->dropDownList($listgls, ['prompt'=>'--Select--']) ?>

        <?= $form->field($modelaccrole, 'description')->textInput(['maxlength' => 200]) ?>

        <div class="form-group">
            <?= Html::submitButton($modelaccrole->isNewRecord ? 'Create' : 'Update', ['class' => $modelaccrole->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    <?php

    Modal::end();
    ?>
<?php
    //create account of the customer
    Modal::begin([
        'header' => '<h2>Product Entry Events</h2>',
        'toggleButton' => ['label' => 'Manage Events','class' => 'btn btn-primary'],
        'size' => Modal::SIZE_LARGE,
        'options' => ['class'=>'slide'],
    ]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataEvents,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'account_role_code',
            'transaction_code',
            'dr_cr_indicator',
            [
                'class'=>'kartik\grid\EditableColumn',

                'attribute' => 'role_type',
                'refreshGrid' => true,
                //'format'=>['decimal', 2],
                'editableOptions'=> [
                    'header'=>'Name',
                    'size'=>'md',
                    'formOptions' => ['action' => ['cart/editcart']],
                    'asPopover' => true,
                    // 'inputType'=>\kartik\editable\Editable::INPUT_SPIN,
                    'options'=>[
                        'pluginOptions'=>['min'=>0, 'max'=>5000]
                    ]
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute' => 'mis_head',
                'refreshGrid' => true,
                //'format'=>['decimal', 2],
                'editableOptions'=> [
                    'header'=>'Name',
                    'size'=>'md',
                    'formOptions' => ['action' => ['cart/editcart']],
                    'asPopover' => true,
                    // 'inputType'=>\kartik\editable\Editable::INPUT_SPIN,
                    'options'=>[
                        'pluginOptions'=>['min'=>0, 'max'=>5000]
                    ]
                ],
            ],




            // 'description',

            [
                'class' => 'yii\grid\ActionColumn','header'=>'Actions',
                'template' => '{view}{delete}{edit}',
                'buttons' => [
                    'delete' => function ($url, $dataRoles) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,[
                                'title' => Yii::t('app', 'Delete'),
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]


                        );
                    },

                ],
                'urlCreator' => function ($action, $dataRoles, $key, $index) {
                    if ($action === 'delete') {

                        $url=Yii::$app->urlManager->createUrl(['product-event-entry/delete', 'id' => $dataRoles->id]);
                        return $url;

                    }
                    elseif ($action === 'view') {

                        $url=Yii::$app->urlManager->createUrl(['product-event-entry/view', 'id' => $dataRoles->id]);
                        return $url;

                    }
                }

            ],
        ],

    ]);
    ?>
    <?php

    Modal::end();
    ?>

    <?php
    Modal::begin([
    'header' => '<h2>New Event Form</h2>',
    'toggleButton' => ['label' => 'New Event','class' => 'btn btn-warning'],
    'size' => Modal::SIZE_LARGE,
    'options' => ['class'=>'slide'],
    ]);
    ?>
    <div class="product-accrole-form">

        <?php $form = ActiveForm::begin([
            'action' => ['product-event-entry/create'],
        ]); ?>

    <?= $form->field($modelevent, 'product_code')->textInput(['value' => $model->product_id]) ?>

    <?= $form->field($modelevent, 'transaction_code')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($modelevent, 'dr_cr_indicator')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($modelevent, 'event_code')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($modelevent, 'account_role_code')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($modelevent, 'role_type')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($modelevent, 'mis_head')->textInput(['maxlength' => 200]) ?>

        <div class="form-group">
            <?= Html::submitButton($modelaccrole->isNewRecord ? 'Create' : 'Update', ['class' => $modelaccrole->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    <?php

    Modal::end();
    ?>
</div>
