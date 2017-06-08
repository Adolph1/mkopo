<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_branch".
 *
 * @property integer $id
 * @property string $branch_name
 * @property string $location
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblDepartment[] $tblDepartments
 * @property TblShelve[] $tblShelves
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_branch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_name'], 'required'],
            [['maker_time'], 'safe'],
            [['branch_name', 'location', 'maker_id'], 'string', 'max' => 200],
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
            'branch_name' => Yii::t('app', 'Branch Name'),
            'location' => Yii::t('app', 'Location'),
            'status' => Yii::t('app', 'Status'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblDepartments()
    {
        return $this->hasMany(Department::className(), ['branch_id' => 'id']);
    }

    //gets all branches

    public static function getAll()
    {
        return ArrayHelper::map(Branch::find()->all(),'id','branch_name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblShelves()
    {
        return $this->hasMany(Shelve::className(), ['branch_id' => 'id']);
    }
}
