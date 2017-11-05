<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_sms_template".
 *
 * @property integer $id
 * @property string $content
 * @property string $status
 */
class SmsTemplate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_sms_template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'status'], 'required'],
            [['content'], 'string'],
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
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public static function getDefault()
    {
        $template=SmsTemplate::find()->where(['status'=>'D'])->one();
        if($template!=null){
            return $template->content;
        }else{
            return "";
        }
    }
}
