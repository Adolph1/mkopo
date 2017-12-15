<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_employee".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $date_of_birth
 * @property string $job_title
 * @property integer $branch_id
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblBranch $branch
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'date_of_birth', 'job_title', 'branch_id','department_id'], 'required'],
            [['date_of_birth', 'maker_time'], 'safe'],
            [['branch_id','department_id'], 'integer'],
            [['first_name', 'middle_name', 'last_name', 'job_title', 'maker_id'], 'string', 'max' => 200],
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
            'first_name' => Yii::t('app', 'First Name'),
            'middle_name' => Yii::t('app', 'Middle Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'date_of_birth' => Yii::t('app', 'Date Of Birth'),
            'job_title' => Yii::t('app', 'Job Title'),
            'branch_id' => Yii::t('app', 'Branch'),
            'department_id' => Yii::t('app', 'Department'),
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

    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    public static function getBranchID($id)
    {
        $emp=Employee::findOne($id);
        if($emp!=null){
            return $emp->branch_id;
        }
        else{
            return "";
        }
    }

    public static function getDepartmentID($id)
    {
        $emp=Employee::findOne($id);
        if($emp!=null){
            return $emp->department_id;
        }
        else{
            return "";
        }
    }

    //gets all Employees
    public static function getAll()
    {
        return ArrayHelper::map(Employee::find()->all(), 'id', function($model, $defaultValue) {
            return $model['first_name']. " " .$model['last_name'];
        });
    }


    public static function getFullNameByEmpID($id)
    {
        $emp = Employee::find()
            ->where(['id' => $id])
            ->orderBy('id DESC')
            ->One();
        if($emp!=null) {
            return $emp->first_name . ' ' . $emp->last_name;
        }
        else{
            return "";
        }

    }

}
