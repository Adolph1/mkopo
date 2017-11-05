<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_student".
 *
 * @property integer $id
 * @property string $reg_no
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property integer $course_id
 * @property string $current_yos
 * @property string $email
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id'], 'integer'],
            [['reg_no'], 'unique'],
            [['reg_no', 'first_name', 'middle_name', 'last_name', 'current_yos','course_id'],'required'],
            [['reg_no', 'first_name', 'middle_name', 'last_name', 'current_yos', 'email'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'reg_no' => Yii::t('app', 'Reg No'),
            'first_name' => Yii::t('app', 'First Name'),
            'middle_name' => Yii::t('app', 'Middle Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'course_id' => Yii::t('app', 'Course'),
            'current_yos' => Yii::t('app', 'Current Year of studies'),
            'email' => Yii::t('app', 'Email'),
        ];
    }

    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }
    public function getYos()
    {
        return $this->hasOne(AcademicYear::className(), ['id' => 'current_yos']);
    }
}
