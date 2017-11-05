<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_payment_type".
 *
 * @property integer $id
 * @property string $title
 * @property string $amount
 */
class PaymentType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_payment_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount'], 'number'],
            [['title'], 'string', 'max' => 200],
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
            'amount' => Yii::t('app', 'Amount'),
        ];
    }
}
