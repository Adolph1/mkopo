<?php

namespace backend\models;
use backend\models\Customer;

use Yii;

/**
 * This is the model class for table "tbl_contract_master".
 *
 * @property string $contract_ref_no
 * @property string $branch
 * @property string $product
 * @property string $product_type
 * @property string $module
 * @property string $payment_method
 * @property string $customer_number
 * @property double $amount
 * @property string $booking_date
 * @property string $value_date
 * @property string $maturity_date
 * @property string $main_component
 * @property double $settle_account
 * @property string $contract_status
 * @property double $main_component_rate
 * @property string $maker_id
 * @property string $maker_stamptime
 * @property string $checker_id
 * @property string $checker_stamptime
 * @property string $seq_number
 *
 * @property TblBranch $branch0
 */
class ContractMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $customer_name;
    public $gridColumns;
    public $id;
    const FLAT_RATE = 1;
    const REDUCING_BALANCE = 2;
    const REDUCING_BALANCE_EXCESS = 3;
    public static function tableName()
    {
        return 'tbl_contract_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contract_ref_no','product','loan_officer', 'product_type','payment_date','frequency', 'payment_method', 'customer_number', 'amount', 'booking_date', 'value_date', 'maturity_date', 'main_component_rate'], 'required'],
            [['amount'], 'number'],
            [['frequency'], 'integer'],
            [['booking_date', 'value_date', 'maturity_date'], 'safe'],
            [['contract_ref_no', 'customer_number', 'main_component','settle_account', 'main_component_rate','maker_id', 'maker_stamptime','loan_officer', 'checker_id', 'checker_stamptime', 'seq_number'], 'string', 'max' => 200],
            [['branch', 'product', 'product_type', 'module', 'payment_method','payment_date', 'contract_status'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'contract_ref_no' => 'Contract Ref No',
            'branch' => 'Branch',
            'product' => 'Product',
            'product_type' => 'Contract Type',
            'module' => 'Module',
            'payment_method' => 'Payment Method',
            'customer_number' => 'Customer Number',
            'amount' => 'Amount',
            'booking_date' => 'Booking Date',
            'value_date' => 'Value Date',
            'maturity_date' => 'Maturity Date',
            'main_component' => 'Main Component',
            'settle_account' => 'Settle Account',
            'contract_status' => 'Contract Status',
            'main_component_rate' => 'Rate',
            'payment_date'=>'First Payment Date',
            'frequency'=>'Frequency',
            'maker_id' => 'Maker ID',
            'maker_stamptime' => 'Maker Stamptime',
            'checker_id' => 'Checker ID',
            'checker_stamptime' => 'Checker Stamptime',
            'seq_number' => 'Seq Number',
            'loan_officer'=>'Loan Officer'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch0()
    {
        return $this->hasOne(Branch::className(), ['branch_id' => 'branch']);
    }



}
