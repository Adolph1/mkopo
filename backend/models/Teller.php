<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_teller".
 *
 * @property integer $id
 * @property string $reference
 * @property string $product
 * @property string $trn_dt
 * @property string $amount
 * @property string $related_customer
 * @property string $offset_account
 * @property string $offset_amount
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 * @property string $checker_id
 * @property string $checker_time
 */
class Teller extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $customer_number;
    public $current_balance;
    public $customer_detail;

    public static function tableName()
    {
        return 'tbl_teller';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reference','product','amount','txn_account'], 'required'],
            [['trn_dt', 'maker_time', 'checker_time'], 'safe'],
            [['amount', 'offset_amount'], 'number'],
            [['reference', 'product','txn_account', 'related_customer', 'offset_account', 'maker_id', 'checker_id'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 1],
            [['reference'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'reference' => Yii::t('app', 'Reference'),
            'product' => Yii::t('app', 'Product'),
            'trn_dt' => Yii::t('app', 'Transaction Date'),
            'amount' => Yii::t('app', 'Amount'),
            'txn_account' => Yii::t('app', 'Transaction Account'),
            'related_customer' => Yii::t('app', 'Related Customer'),
            'offset_account' => Yii::t('app', 'Offset Account'),
            'offset_amount' => Yii::t('app', 'Offset Amount'),
            'status' => Yii::t('app', 'Status'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
            'checker_id' => Yii::t('app', 'Checker ID'),
            'checker_time' => Yii::t('app', 'Checker Time'),
        ];
    }

    public static function getIDByReference($id)
    {
        $teller=Teller::find()->where(['reference'=>$id])->one();
        if($teller!=null){
            return $teller->id;
        }
    }

    public static function getAllTransactions($id)
    {
        $transactions=Teller::find()->where(['related_customer'=>$id])->all();
        if($transactions!=null){
            return $transactions;
        }else{
            return null;
        }
    }

    public static function getUnauthorised()
    {
        $unauthorisedcount = Teller::find()
            ->Where(['status'=>'U'])
            ->count();
        if($unauthorisedcount>0){
            return $unauthorisedcount;
        }else{
            return 0;
        }
    }


}
