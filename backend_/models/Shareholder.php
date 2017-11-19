<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_shareholder".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $address
 * @property string $joining_date
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 */
class Shareholder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_shareholder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['joining_date', 'maker_time'], 'safe'],
            [['title', 'address', 'maker_id'], 'string', 'max' => 200],
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
            'description' => Yii::t('app', 'Description'),
            'address' => Yii::t('app', 'Address'),
            'joining_date' => Yii::t('app', 'Joining Date'),
            'status' => Yii::t('app', 'Status'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    public static function getAll()
    {
        return ArrayHelper::map(Shareholder::find()->all(),'id','title');
    }
}
