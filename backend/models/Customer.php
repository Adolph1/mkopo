<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_customer".
 *
 * @property integer $id
 * @property integer $customer_no
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property integer $identification_id
 * @property string $identification_number
 * @property string $address
 * @property string $mobile_no1
 * @property string $mobile_no2
 * @property string $email
 * @property integer $customer_type_id
 * @property integer $customer_category_id
 * @property integer $branch_id
 * @property string $photo
 * @property integer $mod_no
 * @property string $record_stat
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblBranch $branch
 * @property TblCustomerCategory $customerCategory
 * @property TblCustomerType $customerType
 * @property TblCustomerIdentification $identification
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_no', 'first_name', 'last_name', 'identification_id', 'identification_number', 'mobile_no1', 'customer_type_id'], 'required'],
            [['customer_no', 'identification_id', 'customer_type_id', 'customer_category_id', 'branch_id', 'mod_no'], 'integer'],
            [['maker_time','expire_date'], 'safe'],
            [['first_name', 'middle_name', 'last_name', 'identification_number', 'address', 'email', 'photo', 'maker_id'], 'string', 'max' => 200],
            [['mobile_no1', 'mobile_no2'], 'string', 'max' => 13],
            [['record_stat'], 'string', 'max' => 1],
            [['customer_no'], 'unique'],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
            [['customer_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerCategory::className(), 'targetAttribute' => ['customer_category_id' => 'id']],
            [['customer_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerType::className(), 'targetAttribute' => ['customer_type_id' => 'id']],
            [['identification_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerIdentification::className(), 'targetAttribute' => ['identification_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'customer_no' => Yii::t('app', 'Customer No'),
            'first_name' => Yii::t('app', 'First Name'),
            'middle_name' => Yii::t('app', 'Middle Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'identification_id' => Yii::t('app', 'Identification'),
            'identification_number' => Yii::t('app', 'Identification Number'),
            'expire_date'=> Yii::t('app', 'Expire Date'),
            'address' => Yii::t('app', 'Address'),
            'mobile_no1' => Yii::t('app', 'Mobile No1'),
            'mobile_no2' => Yii::t('app', 'Mobile No2'),
            'email' => Yii::t('app', 'Email'),
            'customer_type_id' => Yii::t('app', 'Customer Type'),
            'customer_category_id' => Yii::t('app', 'Customer Category'),
            'branch_id' => Yii::t('app', 'Branch'),
            'photo' => Yii::t('app', 'Photo'),
            'mod_no' => Yii::t('app', 'Mod No'),
            'record_stat' => Yii::t('app', 'Record Stat'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCategory()
    {
        return $this->hasOne(CustomerCategory::className(), ['id' => 'customer_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerType()
    {
        return $this->hasOne(CustomerType::className(), ['id' => 'customer_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdentification()
    {
        return $this->hasOne(CustomerIdentification::className(), ['id' => 'identification_id']);
    }
}
