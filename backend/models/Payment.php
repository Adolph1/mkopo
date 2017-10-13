<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_payment".
 *
 * @property integer $id
 * @property string $trn_dt
 * @property string $contract_ref_number
 * @property string $component
 * @property string $due_date
 * @property string $amount_paid
 * @property string $related_customer
 * @property string $maker_id
 * @property string $maker_time
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trn_dt', 'due_date', 'maker_time'], 'safe'],
            [['amount_paid','contract_amount_due_id'], 'number'],
            [['contract_ref_number', 'component', 'related_customer', 'maker_id'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trn_dt' => Yii::t('app', 'Trn Dt'),
            'contract_ref_number' => Yii::t('app', 'Contract Ref Number'),
            'component' => Yii::t('app', 'Component'),
            'due_date' => Yii::t('app', 'Due Date'),
            'amount_paid' => Yii::t('app', 'Amount Paid'),
            'related_customer' => Yii::t('app', 'Related Customer'),
            'contract_amount_due_id'=>Yii::t('app', 'Contract Amount Due'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }
}
