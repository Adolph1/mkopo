<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tbl_location".
 *
 * @property integer $id
 * @property string $location_name
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblShelve[] $tblShelves
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['location_name'], 'required'],
            [['maker_time'], 'safe'],
            [['location_name', 'maker_id'], 'string', 'max' => 200],
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
            'location_name' => Yii::t('app', 'Location Name'),
            'status' => Yii::t('app', 'Status'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    //gets all Locations

    public static function getAll()
    {
        return ArrayHelper::map(Location::find()->all(),'id','location_name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblShelves()
    {
        return $this->hasMany(Shelve::className(), ['loc_id' => 'id']);
    }
}
