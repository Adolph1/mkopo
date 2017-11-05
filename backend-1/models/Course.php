<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_course".
 *
 * @property integer $id
 * @property string $course_name
 * @property string $course_fee
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_fee'], 'number'],
            [['course_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'course_name' => Yii::t('app', 'Course Name'),
            'course_fee' => Yii::t('app', 'Course Fee'),
        ];
    }

    //gets all courses

    public static function getAll()
    {
        return ArrayHelper::map(Course::find()->all(),'id','course_name');
    }

    public static function getFeeByID($id)
    {
        $fee=Course::findOne($id);
        if($fee!=null){
            return $fee->course_fee;
        }
        else{
            return " ";
        }
    }
}
