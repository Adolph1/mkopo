<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_system_setup".
 *
 * @property integer $id
 * @property string $system_name
 * @property integer $system_date
 * @property integer $system_rate
 * @property integer $system_grace_period
 * @property string $system_version
 */
class SystemSetup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_system_setup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['system_name', 'system_date', 'system_rate', 'system_grace_period', 'system_version'], 'required'],
            [['id','system_rate', 'system_grace_period','system_stage'], 'integer'],
            [['system_date'], 'safe'],
            [['system_name', 'system_version'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'system_name' => 'System Name',
            'system_date' => 'System Date',
            'system_rate' => 'System Rate',
            'system_stage' => 'System Stage',
            'system_grace_period' => 'System Grace Period',
            'system_version' => 'System Version',
        ];
    }

    public static function getCurrentStage()
    {
        $current_stage=SystemSetup::findOne(1);
        if($current_stage!=null){
            return $current_stage->system_stage;
        }else{
            return 0;
        }
    }

}
