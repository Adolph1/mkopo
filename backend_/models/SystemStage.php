<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_system_stage".
 *
 * @property integer $id
 * @property string $stage
 * @property string $status
 */
class SystemStage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const TI=1;
    const EOTI=2;
    const EOFI=3;
    const EOD=4;

    public static function tableName()
    {
        return 'tbl_system_stage';
    }

    public static function getArrayStages()
    {
        return [
            self::TI => Yii::t('app', 'TRANSACTIONS INPUT'),
            self::EOTI => Yii::t('app', 'END OF TRANSACTIONS INPUT'),
            self::EOFI => Yii::t('app', 'END OF FINANCIAL INPUT'),
            self::EOD => Yii::t('app', 'END OF DAY'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stage'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'stage' => Yii::t('app', 'Stage'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
