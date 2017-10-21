<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_account".
 *
 * @property string $branch_code
 * @property string $cust_ac_no
 * @property string $ac_desc
 * @property integer $cust_no
 * @property string $account_class
 * @property string $ac_stat_no_dr
 * @property string $ac_stat_no_cr
 * @property string $ac_stat_no_block
 * @property string $ac_stat_stop_pay
 * @property string $ac_stat_dormant
 * @property string $acc_open_date
 * @property double $ac_opening_bal
 * @property string $dormancy_date
 * @property integer $dormancy_days
 * @property string $acc_status
 * @property string $maker_id
 * @property string $maker_stamptime
 * @property string $checker_id
 * @property string $check_stamptime
 * @property integer $mod_no
 * @property string $auth_stat
 *
 * @property TblAccountClass $accountClass
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $customer_detail;

    public static function tableName()
    {
        return 'tbl_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_code', 'cust_ac_no', 'ac_desc', 'cust_no', 'account_class',], 'required'],
            [['dormancy_days', 'mod_no'], 'integer'],
            [['ac_opening_bal'], 'number'],
            [['dormancy_date'], 'safe'],
            [['branch_code', 'ac_stat_no_block', 'ac_stat_stop_pay'], 'string', 'max' => 5],
            [['cust_ac_no','cust_no', 'ac_stat_no_dr', 'ac_stat_dormant', 'auth_stat'], 'string', 'max' => 20],
            [['ac_desc', 'account_class', 'acc_open_date', 'acc_status', 'maker_id', 'maker_stamptime', 'checker_id', 'check_stamptime'], 'string', 'max' => 200],
            [['ac_stat_no_cr'], 'string', 'max' => 6],
            [['account_class'], 'exist', 'skipOnError' => true, 'targetClass' => AccountClass::className(), 'targetAttribute' => ['account_class' => 'acc_class']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'branch_code' => Yii::t('app', 'Branch Code'),
            'cust_ac_no' => Yii::t('app', 'Cust Ac No'),
            'ac_desc' => Yii::t('app', 'Ac Desc'),
            'cust_no' => Yii::t('app', 'Cust No'),
            'account_class' => Yii::t('app', 'Account Class'),
            'ac_stat_no_dr' => Yii::t('app', 'Ac Stat No Dr'),
            'ac_stat_no_cr' => Yii::t('app', 'Ac Stat No Cr'),
            'ac_stat_no_block' => Yii::t('app', 'Ac Stat No Block'),
            'ac_stat_stop_pay' => Yii::t('app', 'Ac Stat Stop Pay'),
            'ac_stat_dormant' => Yii::t('app', 'Ac Stat Dormant'),
            'acc_open_date' => Yii::t('app', 'Acc Open Date'),
            'ac_opening_bal' => Yii::t('app', 'Ac Opening Bal'),
            'dormancy_date' => Yii::t('app', 'Dormancy Date'),
            'dormancy_days' => Yii::t('app', 'Dormancy Days'),
            'acc_status' => Yii::t('app', 'Acc Status'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_stamptime' => Yii::t('app', 'Maker Stamptime'),
            'checker_id' => Yii::t('app', 'Checker ID'),
            'check_stamptime' => Yii::t('app', 'Check Stamptime'),
            'mod_no' => Yii::t('app', 'Mod No'),
            'auth_stat' => Yii::t('app', 'Auth Stat'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountClass()
    {
        return $this->hasOne(AccountClass::className(), ['acc_class' => 'account_class']);
    }

    public static function getAllAccounts($id)
    {
        $accounts=Account::find()->where(['cust_no'=>$id])->all();
        if($accounts!=null){
            return $accounts;
        }else{
            return null;
        }
    }
}
