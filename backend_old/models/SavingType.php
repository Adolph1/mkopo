<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_saving_type".
 *
 * @property integer $id
 * @property string $title
 * @property string $status
 * @property string $last_update
 * @property string $maker_id
 * @property string $maker_time
 */
class SavingType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_saving_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['last_update', 'maker_time'], 'safe'],
            [['title', 'maker_id'], 'string', 'max' => 200],
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
            'title' => Yii::t('app', 'Title'),
            'status' => Yii::t('app', 'Status'),
            'last_update' => Yii::t('app', 'Last Update'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }
}
