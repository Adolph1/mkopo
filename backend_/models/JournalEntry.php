<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_journal_entry".
 *
 * @property integer $id
 * @property string $trn_ref_no
 * @property string $trn_dt
 * @property string $credit_account
 * @property string $amount
 * @property string $debit_account
 * @property string $maker_id
 * @property string $maker_time
 * @property string $auth_stat
 * @property string $trn_status
 * @property string $checker_id
 * @property string $checker_time
 */
class JournalEntry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_journal_entry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trn_dt', 'credit_account', 'amount', 'debit_account'], 'required'],
            [['trn_dt', 'maker_time', 'checker_time'], 'safe'],
            [['amount'], 'number'],
            [['trn_ref_no', 'credit_account', 'debit_account', 'maker_id', 'checker_id','description'], 'string', 'max' => 200],
            [['auth_stat', 'trn_status'], 'string', 'max' => 1],
            [['trn_ref_no'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trn_ref_no' => Yii::t('app', 'Trn Ref No'),
            'trn_dt' => Yii::t('app', 'Trn Dt'),
            'credit_account' => Yii::t('app', 'Credit Account'),
            'amount' => Yii::t('app', 'Amount'),
            'debit_account' => Yii::t('app', 'Debit Account'),
            'description' => Yii::t('app', 'Description'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
            'auth_stat' => Yii::t('app', 'Auth Stat'),
            'trn_status' => Yii::t('app', 'Trn Status'),
            'checker_id' => Yii::t('app', 'Checker ID'),
            'checker_time' => Yii::t('app', 'Checker Time'),
        ];
    }

    public static function getDebitAccount($refno)
    {
        $journal=JournalEntry::find()->where(['trn_ref_no'=>$refno])->one();
        if($journal!=null){
            return $journal->debit_account;
        }else{
            return '';
        }
    }

    public static function getCreditAccount($refno)
    {
        $journal=JournalEntry::find()->where(['trn_ref_no'=>$refno])->one();
        if($journal!=null){
            return $journal->credit_account;
        }else{
            return '';
        }
    }
}



