<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_contract_payment".
 *
 * @property integer $id
 * @property string $trn_dt
 * @property integer $transaction_type
 * @property string $contract_ref_number
 * @property string $debit
 * @property string $credit
 * @property string $balance
 * @property string $description
 * @property string $maker_id
 * @property string $maker_time
 * @property string $auth_stat
 * @property string $checker_id
 * @property string $checker_time
 */
class ContractPayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const DISBURSEMENT=1;
    const REPAYMENT=2;
    const REVERSAL=3;
    public $amount;
    public $payment_method;
    public $receipt;

    public static function tableName()
    {
        return 'tbl_contract_payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trn_dt', 'maker_time', 'checker_time'], 'safe'],
            [['transaction_type'], 'integer'],
            [['debit', 'credit', 'balance', 'checker_id'], 'number'],
            [['contract_ref_number', 'description', 'maker_id'], 'string', 'max' => 200],
            [['auth_stat'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trn_dt' => Yii::t('app', 'Transaction Date'),
            'transaction_type' => Yii::t('app', 'Transaction Type'),
            'contract_ref_number' => Yii::t('app', 'Contract Ref Number'),
            'debit' => Yii::t('app', 'Debit'),
            'credit' => Yii::t('app', 'Credit'),
            'balance' => Yii::t('app', 'Balance'),
            'description' => Yii::t('app', 'Description'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
            'auth_stat' => Yii::t('app', 'Auth Stat'),
            'checker_id' => Yii::t('app', 'Checker ID'),
            'checker_time' => Yii::t('app', 'Checker Time'),
        ];
    }

    public static function getLastBalance($id)
    {
        $model = ContractPayment::find()->where(['contract_ref_number'=>$id])->orderBy('id DESC')->one();
        if($model!=null){
            return $model->balance;
        }else{
            return 0;
        }
    }



}
