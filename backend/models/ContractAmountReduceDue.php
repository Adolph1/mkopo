<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_contract_amount_reduce_due".
 *
 * @property integer $id
 * @property string $contract_ref_number
 * @property string $due_date
 * @property string $monthly_payment
 * @property string $interest_amount_due
 * @property string $principal_amount_due
 * @property string $balance
 * @property string $interest_amount_settled
 * @property string $principal_amount_settled
 * @property string $account_due
 * @property string $customer_number
 * @property string $inflow_outflow
 * @property string $basis_amount_tag
 * @property double $adjusted_amount
 * @property string $scheduled_linkage
 * @property string $amount_prepaid
 * @property string $original_due_date
 * @property string $status
 */
class ContractAmountReduceDue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */


    public static function tableName()
    {
        return 'tbl_contract_amount_reduce_due';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['monthly_payment', 'interest_amount_due', 'principal_amount_due', 'balance', 'interest_amount_settled', 'principal_amount_settled', 'adjusted_amount'], 'number'],
            [['contract_ref_number', 'due_date', 'account_due', 'customer_number', 'inflow_outflow', 'basis_amount_tag', 'scheduled_linkage', 'amount_prepaid', 'original_due_date'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'contract_ref_number' => Yii::t('app', 'Contract Ref Number'),
            'due_date' => Yii::t('app', 'Due Date'),
            'monthly_payment' => Yii::t('app', 'Monthly Payment'),
            'interest_amount_due' => Yii::t('app', 'Interest Amount Due'),
            'principal_amount_due' => Yii::t('app', 'Principal Amount Due'),
            'balance' => Yii::t('app', 'Balance'),
            'interest_amount_settled' => Yii::t('app', 'Interest Amount Settled'),
            'principal_amount_settled' => Yii::t('app', 'Principal Amount Settled'),
            'account_due' => Yii::t('app', 'Account Due'),
            'customer_number' => Yii::t('app', 'Customer Number'),
            'inflow_outflow' => Yii::t('app', 'Inflow Outflow'),
            'basis_amount_tag' => Yii::t('app', 'Basis Amount Tag'),
            'adjusted_amount' => Yii::t('app', 'Adjusted Amount'),
            'scheduled_linkage' => Yii::t('app', 'Scheduled Linkage'),
            'amount_prepaid' => Yii::t('app', 'Amount Prepaid'),
            'original_due_date' => Yii::t('app', 'Original Due Date'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public static function getSettled($id)
    {
        $model = ContractAmountReduceDue::find()->where(['contract_ref_number'=>$id])->all();
        if($model!=null){
            $paid=0.00;
            foreach ($model as $item){
                $paid=$paid+$item->interest_amount_settled+$item->principal_amount_settled;
           }
           return $paid;
        }else{
            return 0;
        }
    }
}
