<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_account_class".
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
        return 'tbl_account_class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['acc_class', 'description', 'dormancy', 'record_status', 'maker_id', 'maker_stamptime', 'checker_id', 'check_stamptime', 'auth_status'], 'required'],
            [['acc_class', 'description', 'maker_id', 'maker_stamptime', 'checker_id', 'check_stamptime'], 'string', 'max' => 200],
            [['dormancy', 'record_status', 'auth_status'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'acc_class' => Yii::t('app', 'Acc Class'),
            'description' => Yii::t('app', 'Description'),
            'dormancy' => Yii::t('app', 'Dormancy'),
            'record_status' => Yii::t('app', 'Record Status'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_stamptime' => Yii::t('app', 'Maker Stamptime'),
            'checker_id' => Yii::t('app', 'Checker ID'),
            'check_stamptime' => Yii::t('app', 'Check Stamptime'),
            'auth_status' => Yii::t('app', 'Auth Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblAccounts()
    {
        return $this->hasMany(Account::className(), ['account_class' => 'acc_class']);
    }


    //gets all Account Classes

    public static function getAll()
    {
        return ArrayHelper::map(AccountClass::find()->all(),'acc_class','acc_class');
    }

}
