<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "bank_transaction".
 *
 * @property integer $id
 * @property string $trn_dt
 * @property string $amount
 * @property string $description
 * @property string $source_ref_no
 * @property string $student_reg_no
 * @property integer $payment_type
 * @property string $bank_name
 */
class BankTransaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    const SCENARIO_CREATE = 'create';

    public static function tableName()
    {
        return 'bank_transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trn_dt'], 'safe'],
            [['amount'], 'number'],
            [['payment_type'], 'integer'],
            [['description', 'source_ref_no', 'student_reg_no', 'bank_name'], 'string', 'max' => 200],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['trn_dt','amount','payment_type','source_ref_no','student_reg_no','bank_name'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trn_dt' => Yii::t('app', 'Trn Dt'),
            'amount' => Yii::t('app', 'Amount'),
            'description' => Yii::t('app', 'Description'),
            'source_ref_no' => Yii::t('app', 'Source Ref No'),
            'student_reg_no' => Yii::t('app', 'Student Reg No'),
            'payment_type' => Yii::t('app', 'Payment Type'),
            'bank_name' => Yii::t('app', 'Bank Name'),
        ];
    }

    public function getType()
    {
        return $this->hasOne(PaymentType::className(), ['id' => 'payment_type']);
    }
}
