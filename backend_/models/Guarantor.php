<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_guarantor".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone_number
 * @property string $contract_ref_number
 * @property integer $identification
 * @property string $identification_number
 * @property string $related_customer
 * @property string $maker_id
 * @property string $maker_time
 */
class Guarantor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_guarantor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone_number'], 'required'],
            [['identification'], 'integer'],
            [['maker_time'], 'safe'],
            [['name', 'contract_ref_number', 'identification_number', 'related_customer', 'maker_id'], 'string', 'max' => 200],
            [['phone_number'], 'string', 'max' => 13],
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
            'phone_number' => Yii::t('app', 'Phone Number'),
            'contract_ref_number' => Yii::t('app', 'Contract Ref Number'),
            'identification' => Yii::t('app', 'Identification'),
            'identification_number' => Yii::t('app', 'Identification Number'),
            'related_customer' => Yii::t('app', 'Related Customer'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    public function getIdentificationID()
    {
        return $this->hasOne(CustomerIdentification::className(), ['id' => 'identification']);
    }
}
