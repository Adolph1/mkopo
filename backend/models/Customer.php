<?php

namespace backend\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

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
    public $customer_photo;
    public $current_balance;
    public $customer_detail;
    public $customers;
    const DELETED='D';
    const ACTIVE='O';

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
            [['first_name', 'last_name', 'identification_id', 'identification_number', 'mobile_no1', 'customer_type_id',], 'required'],
            [['identification_id', 'customer_type_id', 'customer_category_id', 'branch_id', 'mod_no','group_id'], 'integer'],
            [['maker_time','expire_date','checker_time','date_of_birth'], 'safe'],
            [['first_name', 'middle_name', 'last_name', 'identification_number','marital_status', 'address', 'email', 'photo', 'maker_id','checker_id','gender'], 'string', 'max' => 200],
            [['mobile_no1', 'mobile_no2'], 'string', 'max' => 13],
            [['customer_no'], 'string', 'max' => 10],
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
            'gender'=> Yii::t('app', 'Gender'),
            'date_of_birth'=> Yii::t('app', 'Date of Birth'),
            'marital_status'=> Yii::t('app', 'Marital Status'),
            'identification_id' => Yii::t('app', 'Identification'),
            'identification_number' => Yii::t('app', 'Identification Number'),
            'expire_date'=> Yii::t('app', 'Expire Date'),
            'address' => Yii::t('app', 'Address'),
            'mobile_no1' => Yii::t('app', 'Mobile No1'),
            'mobile_no2' => Yii::t('app', 'Mobile No2'),
            'email' => Yii::t('app', 'Email'),
            'customer_type_id' => Yii::t('app', 'Type'),
            'customer_category_id' => Yii::t('app', 'Category'),
            'branch_id' => Yii::t('app', 'Branch'),
            'group_id' => Yii::t('app', 'Group'),
            'photo' => Yii::t('app', 'Photo'),
            'mod_no' => Yii::t('app', 'Mod No'),
            'record_stat' => Yii::t('app', 'Status'),
            'maker_id' => Yii::t('app', 'Maker'),
            'maker_time' => Yii::t('app', 'Maker Time'),
            'auth_stat'=> Yii::t('app', 'Authorization status'),
            'checker_id' => Yii::t('app', 'Checker'),
            'checker_time' => Yii::t('app', 'Checker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    public static function getBranchByCustomerNo($id)
    {
        $branch=Customer::find()->where(['customer_no'=>$id])->one();
        if($branch!=null) {
            return $branch->branch_id;
        }else{
            return "";
        }
    }


    public static function getCustPhoneNumber($id)
    {
        $branch=Customer::find()->where(['customer_no'=>$id])->one();
        if($branch!=null) {
            return $branch->mobile_no1;
        }else{
            return "";
        }
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

    public static function getImage($id)
    {
        $model=Customer::find()->where(['id'=>$id])->one();
        return Html::img('uploads/' . $model->photo,
            ['width' => '150px','height'=>'150px','class'=>'img-circle']);
    }

    public static function getCustomer($id)
    {
        $customer = Customer::find()
            ->where(['customer_no' => $id])
            ->orderBy('customer_no DESC')
            ->One();
        return $customer;

    }


    public static function getCustomerAddress($id)
    {
        $customer = Customer::find()
            ->where(['customer_no' => $id])
            ->orderBy('customer_no DESC')
            ->One();
        if($customer!=null){
            return $customer->address.'<br/> '.$customer->mobile_no1;
        }else{
            return '';
        }

    }


    public static function getFullNameByCustomerNumber($id)
    {
        $customer = Customer::find()
            ->where(['customer_no' => $id])
            ->orderBy('customer_no DESC')
            ->One();
        if($customer!=null) {
            return $customer->first_name . ' ' . $customer->last_name;
        }
        else{
            return "";
        }

    }

    //gets all customers
    public static function getAll()
    {
        return ArrayHelper::map(Customer::find()->where(['!=','record_stat','D'])->all(), 'customer_no', function($model, $defaultValue) {
            return $model['first_name']. " " .$model['last_name'];
        });
    }



    public static function getCustomerCount()
    {
        $count = Customer::find()
            ->where(['record_stat'=>Customer::ACTIVE])
            ->count();
        if($count>0){
            return $count;
        }else{
            return 0;
        }
    }
}
