<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_contract_balance".
 *
 * @property integer $id
 * @property string $contract_ref_number
 * @property string $contract_amount
 * @property string $contract_outstanding
 * @property string $last_updated
 */
class ContractBalance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_contract_balance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contract_amount', 'contract_outstanding'], 'number'],
            [['last_updated'], 'safe'],
            [['contract_ref_number'], 'string', 'max' => 200],
            [['contract_ref_number'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'contract_ref_number' => Yii::t('app', 'Contract Ref Number'),
            'contract_amount' => Yii::t('app', 'Contract Amount'),
            'contract_outstanding' => Yii::t('app', 'Contract Outstanding'),
            'last_updated' => Yii::t('app', 'Last Updated'),
        ];
    }

    public static function getOutstanding($id)
    {
        $outstanding = ContractBalance::find()
            ->where(['contract_ref_number'=>$id])
            ->one();
        if($outstanding!=null){
            return $outstanding->contract_outstanding;
        }else{
            return 0;
        }
    }
}
