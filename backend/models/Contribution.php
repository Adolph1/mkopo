<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_contribution".
 *
 * @property integer $id
 * @property string $trn_ref_no
 * @property string $trn_dt
 * @property string $payment_date
 * @property integer $payment_type
 * @property string $customer_number
 * @property string $amount
 * @property integer $contribution_type
 * @property string $period
 * @property string $financial_year
 * @property string $reference
 * @property string $description
 * @property string $auth_stat
 * @property string $maker_id
 * @property string $maker_time
 * @property string $checker_id
 * @property string $checker_time
 */
class Contribution extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_contribution';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contribution_type', 'payment_date', 'reference','amount','period','payment_type', 'product','customer_number','trn_ref_no'], 'required'],
            [['trn_dt', 'payment_date', 'maker_time', 'checker_time'], 'safe'],
            [['payment_type', 'contribution_type'], 'integer'],
            [['amount'], 'number'],
            [['trn_ref_no', 'reference', 'description', 'maker_id', 'checker_id','product'], 'string', 'max' => 200],
            [['customer_number'], 'string', 'max' => 20],
            [['period'], 'string', 'max' => 3],
            [['financial_year'], 'string', 'max' => 6],
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
            'trn_ref_no' => Yii::t('app', 'Trn Ref No'),
            'trn_dt' => Yii::t('app', 'Trn Dt'),
            'payment_date' => Yii::t('app', 'Payment Date'),
            'payment_type' => Yii::t('app', 'Payment Type'),
            'customer_number' => Yii::t('app', 'Customer Number'),
            'amount' => Yii::t('app', 'Amount'),
            'product'  => Yii::t('app', 'Contribution Product'),
            'contribution_type' => Yii::t('app', 'Contribution Type'),
            'period' => Yii::t('app', 'Period'),
            'financial_year' => Yii::t('app', 'Financial Year'),
            'reference' => Yii::t('app', 'Reference'),
            'description' => Yii::t('app', 'Description'),
            'auth_stat' => Yii::t('app', 'Auth Stat'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
            'checker_id' => Yii::t('app', 'Checker ID'),
            'checker_time' => Yii::t('app', 'Checker Time'),
        ];
    }
    public function getType()
    {
        return $this->hasOne(ContributionType::className(), ['id' => 'contribution_type']);
    }
    public function getPayment()
    {
        return $this->hasOne(PaymentMethod::className(), ['id' => 'payment_type']);
    }

    public static function getIDByReference($id)
    {
        $contrb=Contribution::find()->where(['trn_ref_no'=>$id])->one();
        if($contrb!=null){
            return $contrb->id;
        }
    }



}
