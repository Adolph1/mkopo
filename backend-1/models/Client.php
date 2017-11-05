<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_client".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone_number
 * @property string $location
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone_number'], 'required'],
            [['phone_number'], 'unique'],
            [['name', 'location'], 'string', 'max' => 200],
            [['phone_number'], 'string', 'max' => 13],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'location' => Yii::t('app', 'Location'),
        ];
    }
    //gets all clients

    public static function getAll()
    {
        return ArrayHelper::map(Client::find()->all(),'phone_number','name');
    }

    public static function getPhoneNumber($id)
    {
        $client=Client::find()->where(['id'=>$id])->one();

        if($client!=null){
            return $client->phone_number;
        }
        else{
            return "";
        }
    }

     public static function getClientCount()
    {
        $count = Client::find()
            ->count();
        if($count>0){
            return $count;
        }else{
            return 0;
        }
    }
}
