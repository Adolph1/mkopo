<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_saving".
 *
 * @property integer $id
 * @property string $customer_number
 * @property string $trn_date
 * @property string $amount
 * @property string $fc_period
 * @property string $fc_year
 * @property string $description
 * @property string $payment_method
 * @property string $reference
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 * @property string $auth_stat
 * @property string $checker_id
 * @property string $checker_time
 * @property string $next_pay_date
 */
class Saving extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $customer_detail;


    public static function tableName()
    {
        return 'tbl_saving';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trn_date', 'maker_time', 'checker_time', 'next_pay_date'], 'safe'],
            [['amount'], 'number'],
            [['customer_number', 'description', 'payment_method', 'reference', 'maker_id', 'checker_id'], 'string', 'max' => 200],
            [['fc_period'], 'string', 'max' => 3],
            [['fc_year'], 'string', 'max' => 10],
            [['status', 'auth_stat'], 'string', 'max' => 1],
            [['reference'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'customer_number' => Yii::t('app', 'Customer Number'),
            'trn_date' => Yii::t('app', 'Trn Date'),
            'amount' => Yii::t('app', 'Amount'),
            'fc_period' => Yii::t('app', 'Fc Period'),
            'fc_year' => Yii::t('app', 'Fc Year'),
            'description' => Yii::t('app', 'Description'),
            'payment_method' => Yii::t('app', 'Payment Method'),
            'reference' => Yii::t('app', 'Reference'),
            'status' => Yii::t('app', 'Status'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
            'auth_stat' => Yii::t('app', 'Auth Stat'),
            'checker_id' => Yii::t('app', 'Checker ID'),
            'checker_time' => Yii::t('app', 'Checker Time'),
            'next_pay_date' => Yii::t('app', 'Next Pay Date'),
        ];
    }
}
