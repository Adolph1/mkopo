<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_contract_amount_due".
 *
 * @property integer $id
 * @property string $contract_ref_no
 * @property string $component
 * @property string $due_date
 * @property double $amount_due
 * @property string $currency_amt_due
 * @property string $account_due
 * @property string $customer_number
 * @property double $amount_settled
 * @property string $inflow_outflow
 * @property string $basis_amount_tag
 * @property double $adjusted_amount
 * @property string $scheduled_linkage
 * @property string $component_type
 * @property string $amount_prepaid
 * @property string $original_due_date
 */
class ContractAmountDue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $gridColumns;
    public $liquadation_type;
    public $dueinterest;
    public $dueprincipal;
    public $settledinterest;
    public $settledprincipal;
    public static function tableName()
    {
        return 'tbl_contract_amount_due';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount_due', 'amount_settled', 'adjusted_amount'], 'number'],
            [['contract_ref_number', 'liquadation_type','component', 'due_date', 'currency_amt_due', 'account_due', 'customer_number', 'inflow_outflow', 'basis_amount_tag', 'scheduled_linkage', 'component_type', 'amount_prepaid', 'original_due_date'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contract_ref_number' => 'Contract Reference No',
            'component' => 'Component',
            'liquadation_type'=>'Liquadation Method',
            'due_date' => 'Due Date',
            'amount_due' => 'Amount Due',
            'currency_amt_due' => 'Currency Amt Due',
            'account_due' => 'Account Due',
            'customer_number' => 'Customer Number',
            'amount_settled' => 'Amount Settled',
            'inflow_outflow' => 'Inflow Outflow',
            'basis_amount_tag' => 'Basis Amount Tag',
            'adjusted_amount' => 'Adjusted Amount',
            'scheduled_linkage' => 'Scheduled Linkage',
            'component_type' => 'Component Type',
            'amount_prepaid' => 'Amount Prepaid',
            'original_due_date' => 'Original Due Date',
        ];
    }
    public function getContract()
    {
        return $this->hasOne(ContractMaster::className(), ['contract_ref_no' => 'contract_ref_number']);
    }

}
