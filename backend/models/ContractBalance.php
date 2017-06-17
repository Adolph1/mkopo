<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_contract_balance".
 *
 * @property integer $id
 * @property string $contract_ref_number
 * @property double $contract_amount
 * @property double $contract_outstanding
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
            [['contract_ref_number', 'contract_amount', 'contract_outstanding'], 'required'],
            [['contract_amount', 'contract_outstanding'], 'number'],
            [['contract_ref_number'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contract_ref_number' => 'Contract Ref Number',
            'contract_amount' => 'Contract Amount',
            'contract_outstanding' => 'Contract Outstanding',
        ];
    }
}
