<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_shelve".
 *
 * @property integer $id
 * @property string $title
 * @property integer $branch_id
 * @property integer $dept_id
 * @property integer $max_box_no
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblItem[] $tblItems
 * @property TblBranch $branch
 * @property TblDepartment $dept
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
            [['branch_id', 'dept_id', 'max_box_no'], 'integer'],
            [['maker_time'], 'safe'],
            [['title', 'maker_id'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 1],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
            [['dept_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['dept_id' => 'id']],
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
            'branch_id' => Yii::t('app', 'Branch'),
            'dept_id' => Yii::t('app', 'Department'),
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
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDept()
    {
        return $this->hasOne(Department::className(), ['id' => 'dept_id']);
    }

    public static function getAll()
    {
        return ArrayHelper::map(Shelve::find()->all(), 'id', function($model, $defaultValue) {
            return $model->branch->branch_name ." / ". $model->dept->dept_name." / ".$model['title'];
        });
    }


}
