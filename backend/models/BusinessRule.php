<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_business_rule".
 *
 * @property integer $id
 * @property string $rule_code
 * @property string $rule_title
 * @property integer $number
 * @property string $description
 * @property string $maker_id
 * @property string $maker_time
 */
class BusinessRule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_business_rule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number'], 'integer'],
            [['maker_time'], 'safe'],
            [['rule_code'], 'string', 'max' => 4],
            [['rule_title', 'description', 'maker_id'], 'string', 'max' => 200],
            [['rule_code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'rule_code' => Yii::t('app', 'Rule Code'),
            'rule_title' => Yii::t('app', 'Rule Title'),
            'number' => Yii::t('app', 'Number'),
            'description' => Yii::t('app', 'Description'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }
}
