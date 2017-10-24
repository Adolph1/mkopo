<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_eod_cycle".
 *
 * @property integer $id
 * @property string $stage
 * @property string $start_time
 * @property string $end_time
 * @property string $error_code
 * @property string $status
 * @property string $remarks
 */
class EodCycle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_eod_cycle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_time', 'end_time'], 'safe'],
            [['stage', 'error_code', 'remarks'], 'string', 'max' => 200],
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
            'start_time' => Yii::t('app', 'Start Time'),
            'end_time' => Yii::t('app', 'End Time'),
            'error_code' => Yii::t('app', 'Error Code'),
            'status' => Yii::t('app', 'Status'),
            'remarks' => Yii::t('app', 'Remarks'),
        ];
    }
}
