<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_group".
 *
 * @property integer $id
 * @property string $group_name
 * @property string $status
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_name'], 'required'],
            [['group_name'], 'string', 'max' => 200],
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
            'group_name' => Yii::t('app', 'Group Name'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
