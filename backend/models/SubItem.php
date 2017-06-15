<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_sub_item".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $item_id
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblItem $item
 */
class SubItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_sub_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['item_id'], 'integer'],
            [['maker_time'], 'safe'],
            [['title', 'description', 'maker_id'], 'string', 'max' => 200],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
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
            'item_id' => Yii::t('app', 'Item Name'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }
}
