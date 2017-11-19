<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_grace_period".
 *
 * @property integer $id
 * @property integer $period
 * @property string $maker_id
 * @property string $maker_time
 */
class GracePeriod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_grace_period';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['period', 'maker_id', 'maker_time'], 'required'],
            [['period'], 'integer'],
            [['maker_time'], 'safe'],
            [['maker_id'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'period' => 'Period',
            'maker_id' => 'Maker ID',
            'maker_time' => 'Maker Time',
        ];
    }
}
