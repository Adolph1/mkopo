<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_gl_daily_balance".
 *
 * @property integer $id
 * @property string $trn_date
 * @property string $gl_code
 * @property string $opening_balance
 * @property string $dr_turn
 * @property string $cr_turn
 * @property string $closing_balance
 */
class GlDailyBalance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_gl_daily_balance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trn_date'], 'safe'],
            [['opening_balance', 'dr_turn', 'cr_turn', 'closing_balance'], 'number'],
            [['gl_code'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trn_date' => Yii::t('app', 'Trn Date'),
            'gl_code' => Yii::t('app', 'Gl Code'),
            'opening_balance' => Yii::t('app', 'Opening Balance'),
            'dr_turn' => Yii::t('app', 'Dr Turn'),
            'cr_turn' => Yii::t('app', 'Cr Turn'),
            'closing_balance' => Yii::t('app', 'Closing Balance'),
        ];
    }
}
