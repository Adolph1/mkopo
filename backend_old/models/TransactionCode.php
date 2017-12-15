<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_transaction_code".
 *
 * @property integer $trn_id
 * @property string $trn_code
 * @property string $trn_description
 * @property string $maker_id
 * @property string $maker_stamptime
 * @property string $checker_id
 * @property string $checker_stamptime
 * @property string $record_stat
 * @property integer $mod_no
 * @property string $auth_stat
 */
class TransactionCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_transaction_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trn_code', 'trn_description', 'maker_id', 'maker_stamptime', 'checker_id', 'checker_stamptime', 'record_stat', 'mod_no', 'auth_stat'], 'required'],
            [['mod_no','trn_code'], 'integer'],
            [['trn_description', 'maker_id', 'maker_stamptime', 'checker_id', 'checker_stamptime'], 'string', 'max' => 200],
            [['record_stat', 'auth_stat'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'trn_id' => 'Trn ID',
            'trn_code' => 'Trn Code',
            'trn_description' => 'Trn Description',
            'maker_id' => 'Maker ID',
            'maker_stamptime' => 'Maker Stamptime',
            'checker_id' => 'Checker ID',
            'checker_stamptime' => 'Checker Stamptime',
            'record_stat' => 'Record Stat',
            'mod_no' => 'Mod No',
            'auth_stat' => 'Auth Stat',
        ];
    }
}
