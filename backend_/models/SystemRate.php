<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_system_rate".
 *
 * @property integer $id
 * @property string $user_rate
 * @property string $system_rate
 * @property string $last_updated
 * @property string $last_maker
 */
class SystemRate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_system_rate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_rate', 'system_rate'], 'number'],
            [['last_updated'], 'safe'],
            [['last_maker'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_rate' => Yii::t('app', 'User Rate'),
            'system_rate' => Yii::t('app', 'System Rate'),
            'last_updated' => Yii::t('app', 'Last Updated'),
            'last_maker' => Yii::t('app', 'Last Maker'),
        ];
    }

    public static function getSystemRate()
    {
        $system_rate=SystemRate::findOne(1);
        if($system_rate!=null){
            return $system_rate->system_rate;
        }else{
            return 0;
        }
    }

    public static function getUserRate()
    {
        $user_rate=SystemRate::findOne(1);
        if($user_rate!=null){
            return $user_rate->user_rate;
        }else{
            return 0;
        }
    }
}
