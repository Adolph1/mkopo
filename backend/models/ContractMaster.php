<?php

namespace backend\models;
use backend\models\Customer;
use backend\models\ContractAmountDue;

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
    public $officer_detail;
    public $contract_amount;
    public $contract_outstanding;
    public $gridColumns;
    public $total;
    public $id;
    const FLAT_RATE = 1;
    const REDUCING_BALANCE = 2;
    const ACTION_YES=1;
    const ACTION_NO=0;
    const MONTHLY=1;
    const WEEKLY=2;
    const DAILY=3;


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
            [['contract_ref_no','product','loan_officer', 'product_type','payment_date','frequency','settle_account', 'payment_method', 'customer_number', 'amount', 'booking_date', 'value_date', 'maturity_date', 'main_component_rate','calculation_method'], 'required'],
            [['amount'], 'number'],
            [['frequency','calculation_method'], 'integer'],
            [['booking_date', 'value_date', 'maturity_date'], 'safe'],
            [['contract_ref_no', 'customer_number', 'main_component','settle_account', 'main_component_rate','maker_id', 'maker_stamptime','loan_officer', 'checker_id', 'checker_stamptime', 'seq_number'], 'string', 'max' => 200],
            [['branch', 'product', 'product_type', 'module', 'payment_method','payment_date', 'contract_status','auth_stat','is_disbursed'], 'string', 'max' => 20]
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
            'auth_stat'=>'Authorization Status',
            'checker_id' => 'Checker ID',
            'checker_stamptime' => 'Checker Stamptime',
            'seq_number' => 'Seq Number',
            'loan_officer'=>'Loan Officer',
            'calculation_method'=>'Calculation Method',
            'is_disbursed'=>'Is Disbursed',
        ];
    }

    public static function getArrayMethods()
    {
        return [
            self::MONTHLY => Yii::t('app', 'Monthly'),
            self::WEEKLY => Yii::t('app', 'Weekly'),
            self::DAILY => Yii::t('app', 'Daily'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch0()
    {
        return $this->hasOne(Branch::className(), ['branch_id' => 'branch']);
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['customer_no' => 'customer_number']);
    }


    public static function getMatured()
    {
        $matured = ContractMaster::find()
            ->where(['<=','maturity_date',SystemDate::getCurrentDate()])
            ->all();
        if($matured>0){
            return $matured;
        }else{
            return 0;
        }
    }

    public static function getAwaitingDisbursementCount()
    {
        $awaintingcount = ContractMaster::find()
            ->where(['is_disbursed'=>'N'])
            ->andWhere(['auth_stat'=>'A'])
            ->count();
        if($awaintingcount>0){
            return $awaintingcount;
        }else{
            return 0;
        }
    }

    public static function getWrittenOff()
    {
        $writenoff = ContractMaster::find()
            ->andWhere(['auth_stat'=>'A','contract_status'=>'WF'])
            ->count();
        if($writenoff>0){
            return $writenoff;
        }else{
            return 0;
        }
    }

    public static function getAwaitingStatus($id)
    {
        if (($model = ContractMaster::findOne($id)) !== null) {
            return $model->is_disbursed;
        } else {
            return '';
        }
    }


    public static function getSettleAccount($id)
    {
        if (($model = ContractMaster::findOne($id)) !== null) {
            return $model->settle_account;
        } else {
            return '';
        }
    }

    public static function getLoanProduct($id)
    {
        if (($model = ContractMaster::findOne($id)) !== null) {
            return $model->product;
        } else {
            return '';
        }
    }






    public static function getLoanCount()
    {
        $count = ContractMaster::find()
            //->where(['contract_status'=>'A'])
            ->count();
        if($count>0){
            return $count;
        }else{
            return 0;
        }
    }
    public static function getPendingCount()
    {
        $count = ContractMaster::find()
            ->where(['!=','contract_status','D'])
            ->andWhere(['auth_stat'=>'U'])
            ->count();
        if($count>0){
            return $count;
        }else{
            return 0;
        }
    }
    public static function getActiveLoanCount()
    {
        $count = ContractMaster::find()
            ->where(['contract_status'=>'A'])
            ->count();
        if($count>0){
            return $count;
        }else{
            return 0;
        }
    }


    public static function getLiquidatedLoanCount()
    {
        $count = ContractMaster::find()
            ->where(['contract_status'=>'L'])
            ->count();
        if($count>0){
            return $count;
        }else{
            return 0;
        }
    }

    public static function reBook($ref_no,$balance,$customer_no)
    {
        $time=1;
        $rate = SystemRate::getSystemRate();
        $totalRepay = ContractMaster::getInterest($balance, $time, $rate / 100);



        $duemodel = new ContractAmountDue();
        $duemodel->contract_ref_number = $ref_no;
        $duemodel->component = 'PRINCIPAL';
        $duemodel->amount_due = $balance;
        $duemodel->currency_amt_due = 'TZS';
        $duemodel->account_due = $customer_no;
        $duemodel->amount_settled = '0';
        $duemodel->customer_number = $customer_no;
        $duemodel->inflow_outflow = 'O';
        $duemodel->basis_amount_tag = '';
        $duemodel->adjusted_amount = '0';
        $duemodel->scheduled_linkage = '';
        $duemodel->component_type = 'P';
        $duemodel->amount_prepaid = '0';
        $duemodel->due_date =  date('Y-m-d',strtotime("+1 months"));
        $duemodel->original_due_date =date('Y-m-d',strtotime("+1 months"));
        $duemodel->status = 'A';
        $duemodel->save();


        $duemodel1 = new ContractAmountDue();
        $duemodel1->contract_ref_number = $ref_no;
        $duemodel1->currency_amt_due = 'TZS';
        $duemodel1->account_due = $customer_no;
        $duemodel1->amount_settled = '0';
        $duemodel1->customer_number = $customer_no;
        $duemodel1->inflow_outflow = 'O';
        $duemodel1->basis_amount_tag = '';
        $duemodel1->adjusted_amount = '0';
        $duemodel1->scheduled_linkage = '';
        $duemodel1->component_type = 'I';
        $duemodel1->amount_prepaid = '0';
        $duemodel1->due_date = date('Y-m-d',strtotime("+1 months"));
        $duemodel1->original_due_date = date('Y-m-d',strtotime("+1 months"));
        $duemodel1->component = 'INTEREST';
        $duemodel1->amount_due = $totalRepay;
        $duemodel1->status = 'A';

        $duemodel1->save();
        //print_r($duemodel1);
       // exit;

        ContractBalance::updateAll(['contract_outstanding'=>$balance+$totalRepay],['contract_ref_number'=>$ref_no]);
        ContractMaster::updateAll(['maturity_date'=>date('Y-m-d',strtotime("+1 months"))],['contract_ref_no'=>$ref_no]);
    }
    public static function getInterest($p,$t,$r)
    {

        $Interest = ($p * $r * $t);
        return $Interest;
    }

    public static function getContract($id)
    {
        if (($model = ContractMaster::findOne($id)) !== null) {
            return $model;
        } else {
            return '';
        }

    }


}
