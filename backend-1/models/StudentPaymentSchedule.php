<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_student_payment_schedule".
 *
 * @property integer $id
 * @property string $student_reg
 * @property integer $payment_type_id
 * @property string $amount
 * @property integer $year_of_study
 * @property string $amount_settled
 * @property string $last_update
 */
class StudentPaymentSchedule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_student_payment_schedule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_type_id', 'year_of_study'], 'integer'],
            [['amount', 'amount_settled'], 'number'],
            [['last_update'], 'safe'],
            [['student_reg'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'student_reg' => Yii::t('app', 'Student Reg'),
            'payment_type_id' => Yii::t('app', 'Payment Type ID'),
            'amount' => Yii::t('app', 'Amount Due'),
            'year_of_study' => Yii::t('app', 'Year Of Study'),
            'amount_settled' => Yii::t('app', 'Amount Settled'),
            'last_update' => Yii::t('app', 'Last Update'),
        ];
    }

    public function getType()
    {
        return $this->hasOne(PaymentType::className(), ['id' => 'payment_type_id']);
    }
    public function getYos()
    {
        return $this->hasOne(AcademicYear::className(), ['id' => 'year_of_study']);
    }


public static function getAmountDue($stdreg,$ptype)
{
    $balance=StudentPaymentSchedule::find()->where(['student_reg'=>$stdreg,'payment_type_id'=>$ptype])->one();
    if($balance!=null){
        return $balance->amount;
    }
}
    public static function getAmountSettled($stdreg,$ptype)
    {
        $balance=StudentPaymentSchedule::find()->where(['student_reg'=>$stdreg,'payment_type_id'=>$ptype])->one();
        if($balance!=null){
            return $balance->amount_settled;
        }
    }

    public static function updateBalance($stdreg,$ptype,$amount)
    {
        $amountdue=StudentPaymentSchedule::getAmountDue($stdreg,$ptype);
        $amountsettled=StudentPaymentSchedule::getAmountSettled($stdreg,$ptype);
        if($amountdue==0.00){
            return 'up to date';
        }else{
            $amountdue=$amountdue-$amount;
            $amountsettled=$amountsettled+$amount;
            StudentPaymentSchedule::updateAll(['amount'=>$amountdue,'amount_settled'=>$amountsettled],['student_reg'=>$stdreg,'payment_type_id'=>$ptype]);

        }



    }
}
