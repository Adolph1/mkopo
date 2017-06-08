<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_department".
 *
 * @property integer $id
 * @property string $dept_name
 * @property integer $branch_id
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblBranch $branch
 * @property TblShelve[] $tblShelves
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dept_name'], 'required'],
            [['branch_id'], 'integer'],
            [['maker_time'], 'safe'],
            [['dept_name', 'maker_id'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 1],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'dept_name' => Yii::t('app', 'Department Name'),
            'branch_id' => Yii::t('app', 'Branch '),
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


    //gets all departments

    public static function getAll()
    {
        return ArrayHelper::map(Department::find()->all(),'id','dept_name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblShelves()
    {
        return $this->hasMany(Shelve::className(), ['dept_id' => 'id']);
    }
}
