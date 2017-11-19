<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_system_charges".
 *
 * @property integer $id
 * @property string $charge_name
 * @property string $description
 * @property integer $charge
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 */
class SystemCharges extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_system_charges';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['charge_name', 'description', 'charge', 'status', 'maker_id', 'maker_time'], 'required'],
            [['charge'], 'integer'],
            [['maker_time'], 'safe'],
            [['charge_name', 'description', 'status', 'maker_id'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'charge_name' => 'Charge Name',
            'description' => 'Description',
            'charge' => 'Charge',
            'status' => 'Status',
            'maker_id' => 'Maker ID',
            'maker_time' => 'Maker Time',
        ];
    }
}
