<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_sms_log".
 *
 * @property integer $id
 * @property string $created_dt
 * @property string $to
 * @property string $content
 */
class SmsLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $send_to;
    public $total;

    public static function tableName()
    {
        return 'tbl_sms_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_dt'], 'safe'],
            [['content'], 'string'],
            [['to'], 'string', 'max' => 13],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_dt' => Yii::t('app', 'Sent Time'),
            'to' => Yii::t('app', 'To'),
            'content' => Yii::t('app', 'Content'),
        ];
    }

     public static function getMonthlySmsCount()
    {
        $count = SmsLog::find()
            ->Where(['between', 'created_dt', date('Y').'-'.date('m').'-'.'01',  date('Y').'-'.date('m').'-'.'31'])
            ->count();
        if($count>0){
            return $count;
        }else{
            return 0;
        }
    }
}
