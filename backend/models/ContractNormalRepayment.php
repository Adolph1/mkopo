<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_contract_normal_repayment".
 *
 * @property integer $id
 * @property string $contract_ref_number
 * @property string $due_date
 * @property double $contract_amount
 * @property double $interest
 * @property double $contract_outstanding
 * @property double $customer_installment
 * @property double $balance
 * @property integer $month_factor
 * @property double $expected_installment
 */
class ContractNormalRepayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $liquadation_type;

    public static function tableName()
    {
        return 'tbl_contract_normal_repayment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_installment'], 'required'],
            [['due_date'], 'safe'],
            [['contract_amount', 'interest','full_oustanding', 'contract_outstanding', 'customer_installment', 'balance', 'expected_installment'], 'number'],
            [['month_factor'], 'integer'],
            [['contract_ref_number'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status'=>'Status',
            'contract_ref_number' => 'Contract Ref Number',
            'due_date' => 'Due Date',
            'contract_amount' => 'Contract Amount',
            'interest' => 'Interest',
            'pre_liquidation'=>'Pre Liquidation amount',
            'pre_liquidation_rate'=>'Pre Liquidation Rate',
            'maker_time'=>'Make Time',
            'maker_id'=>'Maker',
            'contract_outstanding' => 'Contract Outstanding',
            'customer_installment' => 'Customer Installment',
            'full_oustanding'=>'Full Outstanding',
            'balance' => 'Balance',
            'liquidation_type'=>'Liquidation Type',
            'month_factor' => 'Month Factor',
            'expected_installment' => 'Expected Installment',
        ];
    }
}
