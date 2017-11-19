<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_department".
 *
 * @property integer $id
 * @property string $dept_name
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
            [['dept_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'dept_name' => Yii::t('app', 'Dept Name'),
        ];
    }



    public static function getAll()
    {
        return ArrayHelper::map(Department::find()->all(),'id','dept_name');
    }
    
        public static function getDepartmentName($id)
    {
        $branch=Department::find()->where(['id'=>$id])->one();
        if($branch!=null){
            return $branch->dept_name;
        }
        else{
            return "";
        }
    }
}
