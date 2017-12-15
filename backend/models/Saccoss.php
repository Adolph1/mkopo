<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_saccoss".
 *
 * @property integer $id
 * @property string $title
 * @property string $background
 * @property string $address
 */
class Saccoss extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_saccoss';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['background'], 'string'],
            [['title', 'address'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'background' => Yii::t('app', 'Background'),
            'address' => Yii::t('app', 'Address'),
        ];
    }

    //gets title
    public static function getTitle()
    {
        $model=Saccoss::findOne(1);
        if($model!=null){
            return $model->title;
        }else{
            return 'Saccoss Title not set';
        }
    }
}
