<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "system_dates".
 *
 * @property integer $id
 * @property string $previous_working_day
 * @property string $current_working_day
 * @property string $next_working_day
 */
class SystemDates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_dates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'previous_working_day', 'current_working_day', 'next_working_day'], 'required'],
            [['id'], 'integer'],
            [['previous_working_day', 'current_working_day', 'next_working_day'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'previous_working_day' => 'Previous Working Day',
            'current_working_day' => 'Current Working Day',
            'next_working_day' => 'Next Working Day',
        ];
    }
}
