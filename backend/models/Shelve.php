<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_shelve".
 *
 * @property integer $id
 * @property string $title
 * @property integer $loc_id
 * @property integer $max_box_no
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblItem[] $tblItems
 * @property TblLocation $loc
 */
class Shelve extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_shelve';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['loc_id', 'max_box_no'], 'integer'],
            [['maker_time'], 'safe'],
            [['title', 'maker_id'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 1],
            [['loc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['loc_id' => 'id']],
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
            'loc_id' => Yii::t('app', 'Location'),
            'max_box_no' => Yii::t('app', 'Max Box No'),
            'status' => Yii::t('app', 'Status'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblItems()
    {
        return $this->hasMany(Item::className(), ['shelve_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoc()
    {
        return $this->hasOne(Location::className(), ['id' => 'loc_id']);
    }
}
