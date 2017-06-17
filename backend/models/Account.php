<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_account".
 *
 * @property string $branch_code
 * @property integer $cust_ac_no
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
    public $acc;
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
            [['branch_code', 'cust_ac_no', 'ac_desc', 'cust_no', 'account_class','ac_opening_bal'], 'required'],
            [['cust_ac_no', 'cust_no', 'dormancy_days', 'mod_no'], 'integer'],
            [['ac_opening_bal'], 'number'],
            [['dormancy_date'], 'safe'],
            [['branch_code', 'ac_stat_no_block', 'ac_stat_stop_pay'], 'string', 'max' => 5],
            [['ac_desc', 'account_class', 'acc_open_date', 'acc_status', 'maker_id', 'maker_stamptime', 'checker_id', 'check_stamptime'], 'string', 'max' => 200],
            [['ac_stat_no_dr', 'ac_stat_dormant', 'auth_stat'], 'string', 'max' => 20],
            [['ac_stat_no_cr'], 'string', 'max' => 6]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'branch_code' => 'Branch Code',
            'cust_ac_no' => 'Customer Account No',
            'ac_desc' => 'Customer Name',
            'cust_no' => 'Customer Number',
            'account_class' => 'Account Class',
            'ac_stat_no_dr' => 'Ac Stat No Dr',
            'ac_stat_no_cr' => 'Ac Stat No Cr',
            'ac_stat_no_block' => 'Ac Stat No Block',
            'ac_stat_stop_pay' => 'Ac Stat Stop Pay',
            'ac_stat_dormant' => 'Ac Stat Dormant',
            'acc_open_date' => 'Acc Open Date',
            'ac_opening_bal' => 'Ac Opening Bal',
            'dormancy_date' => 'Dormancy Date',
            'dormancy_days' => 'Dormancy Days',
            'acc_status' => 'Acc Status',
            'maker_id' => 'Maker ID',
            'maker_stamptime' => 'Maker Stamptime',
            'checker_id' => 'Checker ID',
            'check_stamptime' => 'Check Stamptime',
            'mod_no' => 'Mod No',
            'auth_stat' => 'Auth Stat',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountClass()
    {
        return $this->hasOne(TblAccountClass::className(), ['acc_class' => 'account_class']);
    }
}
