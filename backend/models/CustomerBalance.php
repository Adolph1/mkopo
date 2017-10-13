<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_customer_balance".
 *
 * @property integer $id
 * @property string $customer_number
 * @property string $opening_balance
 * @property string $current_balance
 * @property string $last_updated
 */
class CustomerBalance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_customer_balance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_number'], 'required'],
            [['opening_balance', 'current_balance'], 'number'],
            [['last_updated'], 'safe'],
            [['customer_number'], 'string', 'max' => 200],
            [['customer_number'], 'unique'],
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
            'opening_balance' => Yii::t('app', 'Opening Balance'),
            'current_balance' => Yii::t('app', 'Current Balance'),
            'last_updated' => Yii::t('app', 'Last Updated'),
        ];
    }

    public static function getBalance($id)
    {
        $balance=CustomerBalance::find()->where(['customer_number'=>$id])->one();
        if($balance!=null){
            return $balance->current_balance;
        }
        else{
            return 0.00;
        }
    }
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['customer_no' => 'customer_number']);
    }
}
