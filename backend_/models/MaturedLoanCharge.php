<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_matured_loan_charge".
 *
 * @property integer $id
 * @property string $contract_ref_number
 * @property string $matured_date
 * @property string $charge_amount
 * @property integer $months
 * @property string $last_update
 */
class MaturedLoanCharge extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_matured_loan_charge';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['matured_date', 'last_update'], 'safe'],
            [['charge_amount'], 'number'],
            [['months'], 'integer'],
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
            'matured_date' => Yii::t('app', 'Matured Date'),
            'charge_amount' => Yii::t('app', 'Charge Amount'),
            'months' => Yii::t('app', 'Months'),
            'last_update' => Yii::t('app', 'Last Update'),
        ];
    }
}
