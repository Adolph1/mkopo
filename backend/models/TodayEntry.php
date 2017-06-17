<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_today_entry".
 *
 * @property integer $id
 * @property string $module
 * @property string $trn_ref_no
 * @property string $trn_dt
 * @property string $entry_sr_no
 * @property string $ac_no
 * @property string $ac_branch
 * @property string $event_sr_no
 * @property string $event
 * @property double $amount
 * @property string $amount_tag
 * @property string $drcr_ind
 * @property string $trn_code
 * @property string $related_customer
 * @property string $batch_no
 * @property string $product
 * @property string $value_dt
 * @property string $finacial_year
 * @property string $period_code
 * @property string $maker_id
 * @property string $maker_stamptime
 * @property string $checker_id
 * @property string $auth_stat
 * @property string $delete_stat
 * @property string $instrument_code
 */
class TodayEntry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_today_entry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['batch_number'], 'integer'],
            [['amount'], 'number'],
            [['module', 'trn_ref_no', 'trn_dt', 'entry_sr_no', 'ac_no', 'ac_branch', 'event_sr_no', 'event','amount_tag', 'drcr_ind', 'trn_code', 'related_customer','product', 'value_dt', 'finacial_year', 'period_code', 'maker_id', 'maker_stamptime', 'checker_id', 'auth_stat', 'delete_stat', 'instrument_code'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'module' => 'Module',
            'trn_ref_no' => 'Trn Ref No',
            'trn_dt' => 'Trn Dt',
            'entry_sr_no' => 'Entry Sr No',
            'ac_no' => 'Ac No',
            'ac_branch' => 'Ac Branch',
            'event_sr_no' => 'Event Sr No',
            'event' => 'Event',
            'amount' => 'Amount',
            'amount_tag' => 'Amount Tag',
            'drcr_ind' => 'Drcr Ind',
            'trn_code' => 'Trn Code',
            'related_customer' => 'Related Customer',
            'batch_number' => 'Batch Number',
            'product' => 'Product',
            'value_dt' => 'Value Dt',
            'finacial_year' => 'Finacial Year',
            'period_code' => 'Period Code',
            'maker_id' => 'Maker ID',
            'maker_stamptime' => 'Maker Stamptime',
            'checker_id' => 'Checker ID',
            'auth_stat' => 'Auth Stat',
            'delete_stat' => 'Delete Stat',
            'instrument_code' => 'Instrument Code',
        ];
    }
}
