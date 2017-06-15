<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_customer_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $indicator
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblCustomer[] $tblCustomers
 */
class CustomerType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_customer_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['maker_time'], 'safe'],
            [['name', 'maker_id'], 'string', 'max' => 200],
            [['indicator'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'indicator' => Yii::t('app', 'Indicator'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    //gets all customer types

    public static function getAll()
    {
        return ArrayHelper::map(CustomerType::find()->all(),'id','name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblCustomers()
    {
        return $this->hasMany(Customer::className(), ['customer_type_id' => 'id']);
    }
}
