<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_eod".
 *
 * @property integer $id
 * @property string $process_function
 * @property string $process_description
 * @property string $status
 * @property string $starttime
 * @property string $endtime
 */
class Eod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_eod';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['process_function', 'process_description', 'status', 'starttime', 'endtime'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'process_function' => Yii::t('app', 'Process Function'),
            'process_description' => Yii::t('app', 'Process Description'),
            'status' => Yii::t('app', 'Status'),
            'starttime' => Yii::t('app', 'Starttime'),
            'endtime' => Yii::t('app', 'Endtime'),
        ];
    }
}
