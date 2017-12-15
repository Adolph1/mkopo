<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_customer_category".
 *
 * @property integer $id
 * @property string $category
 * @property string $code
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblCustomer[] $tblCustomers
 */
class CustomerCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_customer_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category'], 'required'],
            [['maker_time'], 'safe'],
            [['category', 'maker_id'], 'string', 'max' => 200],
            [['code'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category' => Yii::t('app', 'Category'),
            'code' => Yii::t('app', 'Code'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    //gets all customer categories

    public static function getAll()
    {
        return ArrayHelper::map(CustomerCategory::find()->all(),'id','category');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblCustomers()
    {
        return $this->hasMany(Customer::className(), ['customer_category_id' => 'id']);
    }
}
