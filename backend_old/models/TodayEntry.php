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
            [['batch_number','ac_branch','event'], 'integer'],
            [['amount'], 'number'],
            [['module', 'trn_ref_no', 'trn_dt', 'entry_sr_no', 'ac_no', 'event_sr_no', 'amount_tag', 'drcr_ind', 'trn_code', 'related_customer','product', 'value_dt', 'finacial_year', 'period_code', 'maker_id', 'maker_stamptime', 'checker_id', 'auth_stat', 'delete_stat', 'instrument_code'], 'string', 'max' => 200]
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
            'maker_id' => 'Maker ',
            'maker_stamptime' => 'Maker Time',
            'checker_id' => 'Checker ',
            'auth_stat' => 'Auth Stat',
            'delete_stat' => 'Delete Stat',
            'instrument_code' => 'Instrument Code',
        ];
    }

    //saves today entry

    public static function saveEntry($module,$ref,$trn_dt,$acc,$branch,$amount,$ind,$customer,$product,$value_date,$event)
    {
        $model=new TodayEntry();
        $model->ac_branch=$branch;
        $model->ac_no=$acc;
        $model->amount=$amount;
        $model->event=$event;
        $model->module=$module;
        $model->trn_ref_no=$ref;
        $model->trn_dt=$trn_dt;
        $model->drcr_ind=$ind;
        $model->related_customer=$customer;
        $model->product=$product;
        $model->value_dt=$value_date;
        $model->auth_stat='U';
        $model->maker_id=Yii::$app->user->identity->username;
        $model->maker_stamptime=date('Y-m-d H:i:s');
        $model->period_code='M'.date('m');
        $model->finacial_year='FY'.date('Y');
        $model->save();
        //return $model;

    }

    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'ac_branch']);
    }

    public static function getUnauthorised()
    {
         $count=TodayEntry::find()->where(['auth_stat'=>'U','trn_dt'=>SystemDate::getCurrentDate()])->andWhere(['!=','delete_stat','D'])->count();
         return $count;
    }


}
