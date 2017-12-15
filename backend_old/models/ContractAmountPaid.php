<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_contract_amount_paid".
 *
 * @property integer $id
 * @property string $contract_ref_no
 * @property string $component
 * @property string $due_date
 * @property string $paid_date
 * @property string $currency_settled
 * @property string $account_settled
 * @property string $customer_number
 * @property double $amount_settled
 * @property string $inflow_outflow
 * @property double $base_amount
 * @property string $amount_prepaid
 * @property string $payment_status
 * @property string $accounting_passed
 * @property string $message_sent
 */
class ContractAmountPaid extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_contract_amount_paid';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contract_ref_no', 'component', 'due_date', 'paid_date', 'currency_settled', 'account_settled', 'customer_number', 'amount_settled', 'inflow_outflow', 'base_amount', 'amount_prepaid', 'payment_status', 'accounting_passed', 'message_sent'], 'required'],
            [['amount_settled', 'base_amount'], 'number'],
            [['contract_ref_no', 'component', 'due_date', 'paid_date', 'currency_settled', 'account_settled', 'customer_number', 'inflow_outflow', 'amount_prepaid', 'payment_status'], 'string', 'max' => 200],
            [['accounting_passed', 'message_sent'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contract_ref_no' => 'Contract Ref No',
            'component' => 'Component',
            'due_date' => 'Due Date',
            'paid_date' => 'Paid Date',
            'currency_settled' => 'Currency Settled',
            'account_settled' => 'Account Settled',
            'customer_number' => 'Customer Number',
            'amount_settled' => 'Amount Settled',
            'inflow_outflow' => 'Inflow Outflow',
            'base_amount' => 'Base Amount',
            'amount_prepaid' => 'Amount Prepaid',
            'payment_status' => 'Payment Status',
            'accounting_passed' => 'Accounting Passed',
            'message_sent' => 'Message Sent',
        ];
    }
}
