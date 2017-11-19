<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_contract_amount".
 *
 * @property integer $id
 * @property string $contract_ref_number
 * @property string $due_date
 * @property double $amount_due
 * @property string $account_due
 * @property string $customer_number
 * @property double $amount_settled
 */
class ContractAmount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_contract_amount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contract_ref_number', 'due_date', 'amount_due', 'customer_number', 'amount_settled'], 'required'],
            [['amount_due', 'amount_settled'], 'number'],
            [['contract_ref_number', 'due_date', 'account_due', 'customer_number','status'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contract_ref_number' => 'Contract Ref Number',
            'due_date' => 'Due Date',
            'amount_due' => 'Amount Due',
            'account_due' => 'Account Due',
            'customer_number' => 'Customer Number',
            'amount_settled' => 'Amount Settled',
        ];
    }
    public function getPrincipal($ref,$dt)
    {
        $comp1 = ContractAmountDue::find()
            ->where(['contract_ref_number' => $ref,'due_date'=>$dt,'component_type'=>'P'])
            ->orderBy('contract_ref_number DESC')
            ->One();
        return $comp1;

    }
    public function getInterest($ref,$dt)
    {
        $comp2 = ContractAmountDue::find()
            ->where(['contract_ref_number' => $ref,'due_date'=>$dt,'component_type'=>'I'])
            ->orderBy('contract_ref_number DESC')
            ->One();
        return $comp2;

    }
}
