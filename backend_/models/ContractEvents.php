<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_contract_events".
 *
 * @property integer $id
 * @property string $event_name
 * @property string $description
 */
class ContractEvents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_contract_events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_name', 'description'], 'required'],
            [['event_name', 'description'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_name' => 'Event Name',
            'description' => 'Description',
        ];
    }
}
