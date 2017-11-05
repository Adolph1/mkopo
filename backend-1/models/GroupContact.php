<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_group_contact".
 *
 * @property integer $id
 * @property integer $group_id
 * @property integer $client_id
 */
class GroupContact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_group_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'client_id'], 'integer'],
            [['client_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'group_id' => Yii::t('app', 'Group ID'),
            'client_id' => Yii::t('app', 'Client ID'),
        ];
    }
    
}
