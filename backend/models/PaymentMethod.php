<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_contract_payment_method".
 *
 * @property integer $id
 * @property string $method
 * @property string $method_abbreviation
 * @property string $maker_id
 * @property string $maker_stamptime
 */
class PaymentMethod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_contract_payment_method';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['method', 'method_abbreviation', 'maker_id', 'maker_stamptime'], 'required'],
            [['method', 'method_abbreviation', 'maker_id', 'maker_stamptime'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'method' => 'Method',
            'method_abbreviation' => 'Method Abbreviation',
            'maker_id' => 'Maker ID',
            'maker_stamptime' => 'Maker Stamptime',
        ];
    }
    //gets all payment methods

    public static function getAll()
    {
        return ArrayHelper::map(PaymentMethod::find()->all(),'id','method');
    }

}
