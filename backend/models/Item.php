<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_item".
 *
 * @property integer $id
 * @property string $item_reference
 * @property string $item_name
 * @property string $year
 * @property string $description
 * @property integer $shelve_id
 * @property integer $branch_id
 * @property integer $location_id
 * @property integer $department_id
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblBranch $branch
 * @property TblDepartment $department
 * @property TblLocation $location
 * @property TblShelve $shelve
 * @property TblSubItem[] $tblSubItems
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
            [['item_name', 'description','department_id','location_id'], 'required'],
            [['description'], 'string'],
            [['shelve_id', 'branch_id', 'location_id', 'department_id'], 'integer'],
            [['maker_time'], 'safe'],
            [['item_reference'], 'string', 'max' => 255],
            [['item_name', 'maker_id'], 'string', 'max' => 200],
            [['year'], 'string', 'max' => 5],
            [['status'], 'string', 'max' => 1],
            [['item_reference'], 'unique'],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['location_id' => 'id']],
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
            'item_reference' => Yii::t('app', 'Access Path'),
            'item_name' => Yii::t('app', 'Box Name'),
            'year' => Yii::t('app', 'Year'),
            'description' => Yii::t('app', 'Description'),
            'shelve_id' => Yii::t('app', 'Shelve Details'),
            'branch_id' => Yii::t('app', 'From Branch'),
            'location_id' => Yii::t('app', 'Location'),
            'department_id' => Yii::t('app', 'From Department'),
            'status' => Yii::t('app', 'Status'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShelve()
    {
        return $this->hasOne(Shelve::className(), ['id' => 'shelve_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblSubItems()
    {
        return $this->hasMany(SubItem::className(), ['item_id' => 'id']);
    }
}
