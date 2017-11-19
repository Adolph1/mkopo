<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_group".
 *
 * @property integer $id
 * @property string $group_name
 * @property string $group_number
 * @property string $branch_code
 * @property string $location
 * @property integer $loan_officer
 * @property string $registration_date
 * @property string $auth_status
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 * @property string $checker_id
 * @property string $checker_time
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_name', 'branch_code', 'location', 'loan_officer', 'registration_date'], 'required'],
            [['loan_officer'], 'integer'],
            [['registration_date', 'maker_time', 'checker_time'], 'safe'],
            [['group_name', 'location', 'maker_id', 'checker_id'], 'string', 'max' => 200],
            [['group_number', 'branch_code'], 'string', 'max' => 10],
            [['auth_status', 'status'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'group_name' => Yii::t('app', 'Group Name'),
            'group_number' => Yii::t('app', 'Group Number'),
            'branch_code' => Yii::t('app', 'Branch'),
            'location' => Yii::t('app', 'Location'),
            'loan_officer' => Yii::t('app', 'Loan Officer'),
            'registration_date' => Yii::t('app', 'Registration Date'),
            'auth_status' => Yii::t('app', 'Auth Status'),
            'status' => Yii::t('app', 'Status'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
            'checker_id' => Yii::t('app', 'Checker ID'),
            'checker_time' => Yii::t('app', 'Checker Time'),
        ];
    }


    //gets all Groups

    public static function getAll()
    {
        return ArrayHelper::map(Group::find()->where(['auth_status'=>'A','status'=>'A'])->all(),'id','group_name');
    }

    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_code']);
    }



    //gets last member id
    public static function findLast()
    {

        $model = Group::find()->orderBy('id DESC')->one();

        if ($model != null) {
            $model->group_number =sprintf("%04d", $model->group_number + 1);
            return $model->group_number;
        }
        else {

            $model = new Group();
            $model->group_number = '0001';
            return $model->group_number;

        }

    }
}
