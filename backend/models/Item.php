<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_item".
 *
 * @property integer $id
 * @property string $item_reference
 * @property string $item_name
 * @property string $year
 * @property string $description
 * @property integer $shelve_id
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblShelve $shelve
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_reference', 'item_name', 'description'], 'required'],
            [['description'], 'string'],
            [['shelve_id'], 'integer'],
            [['maker_time'], 'safe'],
            [['item_reference'], 'string', 'max' => 255],
            [['item_name', 'maker_id'], 'string', 'max' => 200],
            [['year'], 'string', 'max' => 5],
            [['status'], 'string', 'max' => 1],
            [['item_reference'], 'unique'],
            [['shelve_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shelve::className(), 'targetAttribute' => ['shelve_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'item_reference' => Yii::t('app', 'Item Reference'),
            'item_name' => Yii::t('app', 'Item Name'),
            'year' => Yii::t('app', 'Year'),
            'description' => Yii::t('app', 'Description'),
            'shelve_id' => Yii::t('app', 'Shelve Details'),
            'status' => Yii::t('app', 'Status'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShelve()
    {
        return $this->hasOne(Shelve::className(), ['id' => 'shelve_id']);
    }


}
