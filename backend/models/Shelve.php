<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
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
            [['loc_id', 'max_box_no','balance'], 'integer'],
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
            'balance'=>Yii::t('app', 'Balance'),
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


    //gets all Shelves

    public static function getAll()
    {
        return ArrayHelper::map(Shelve::find()->all(),'id','title');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoc()
    {
        return $this->hasOne(Location::className(), ['id' => 'loc_id']);
    }

    public static function getEmptySpace($id)
    {
         $model=Shelve::find()->where(['!=','balance','null'])->andFilterWhere(['loc_id'=>$id])->one();
        return $model;

    }

}
