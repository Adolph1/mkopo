<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_system_date".
 *
 * @property integer $id
 * @property string $previous_working_day
 * @property string $current_working_day
 * @property string $next_working_day
 */
class SystemDate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_system_date';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['previous_working_day', 'current_working_day', 'next_working_day'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'previous_working_day' => Yii::t('app', 'Previous Working Day'),
            'current_working_day' => Yii::t('app', 'Current Working Day'),
            'next_working_day' => Yii::t('app', 'Next Working Day'),
        ];
    }

    public static function getCurrentDate()
    {
        $current_date=SystemDate::findOne(1);
        if($current_date!=null){
            return $current_date->current_working_day;
        }else{
            return 0;
        }
    }
}
