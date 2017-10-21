<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_branch".
 *
 * @property integer $id
 * @property string $branch_code
 * @property string $branch_name
 * @property string $location
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblCustomer[] $tblCustomers
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_branch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_code', 'branch_name'], 'required'],
            [['maker_time'], 'safe'],
            [['branch_code'], 'string', 'max' => 3],
            [['branch_name', 'location', 'maker_id'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 1],
            [['branch_code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'branch_code' => Yii::t('app', 'Branch Code'),
            'branch_name' => Yii::t('app', 'Branch Name'),
            'location' => Yii::t('app', 'Location'),
            'status' => Yii::t('app', 'Status'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblCustomers()
    {
        return $this->hasMany(TblCustomer::className(), ['branch_id' => 'id']);
    }


    //gets all Branches

    public static function getAll()
    {
        return ArrayHelper::map(Branch::find()->all(),'id','branch_name');
    }

    //gets all Branches

    public static function getBranchCodes()
    {
        return ArrayHelper::map(Branch::find()->all(),'branch_code','branch_name');
    }

}
