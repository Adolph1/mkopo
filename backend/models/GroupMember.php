<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_group_member".
 *
 * @property integer $id
 * @property string $member_number
 * @property integer $group_id
 * @property string $maker_id
 * @property string $maker_time
 */
class GroupMember extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_group_member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_number', 'group_id'], 'required'],
            [['group_id'], 'integer'],
            [['maker_time'], 'safe'],
            [['member_number', 'maker_id'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'member_number' => Yii::t('app', 'Member Number'),
            'group_id' => Yii::t('app', 'Group ID'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }
}
