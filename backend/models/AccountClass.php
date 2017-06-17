<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_account_class}}".
 *
 * @property string $acc_class
 * @property string $description
 * @property string $dormancy
 * @property string $record_status
 * @property string $maker_id
 * @property string $maker_stamptime
 * @property string $checker_id
 * @property string $check_stamptime
 * @property string $auth_status
 *
 * @property TblAccount[] $tblAccounts
 */
class AccountClass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_account_class}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['acc_class', 'description', 'dormancy', 'record_status', 'maker_id', 'maker_stamptime', 'checker_id', 'check_stamptime', 'auth_status'], 'required'],
            [['acc_class', 'description', 'maker_id', 'maker_stamptime', 'checker_id', 'check_stamptime'], 'string', 'max' => 200],
            [['dormancy', 'record_status', 'auth_status'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'acc_class' => 'Acc Class',
            'description' => 'Description',
            'dormancy' => 'Dormancy',
            'record_status' => 'Record Status',
            'maker_id' => 'Maker ID',
            'maker_stamptime' => 'Maker Stamptime',
            'checker_id' => 'Checker ID',
            'check_stamptime' => 'Check Stamptime',
            'auth_status' => 'Auth Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblAccounts()
    {
        return $this->hasMany(TblAccount::className(), ['account_class' => 'acc_class']);
    }
}
