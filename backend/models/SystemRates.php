<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_system_rates".
 *
 * @property integer $id
 * @property string $rate_name
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 */
class SystemRates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_system_rates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rate_name', 'status', 'maker_id', 'maker_time'], 'required'],
            [['maker_time'], 'safe'],
            [['rate_name', 'status', 'maker_id'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rate_name' => 'Rate Name',
            'status' => 'Status',
            'maker_id' => 'Maker ID',
            'maker_time' => 'Maker Time',
        ];
    }
}
