<?php
/**
 * Created by PhpStorm.
 * User: adotech
 * Date: 10/17/17
 * Time: 12:38 PM
 */
?>
<?php
$searchModel = new \backend\models\BusinessRuleSearch();
$dataProvider = $searchModel->searchAll();
?>
<?= \fedemotta\datatables\DataTables::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        //'id',
        'rule_code',
        'rule_title',
        'number',
        'description',

        ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
    ],
]); ?>
