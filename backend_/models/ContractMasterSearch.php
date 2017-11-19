<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ContractMaster;

/**
 * ContractMasterSearch represents the model behind the search form about `backend\models\ContractMaster`.
 */
class ContractMasterSearch extends ContractMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contract_ref_no', 'branch', 'product', 'product_type', 'module', 'payment_method', 'customer_number', 'booking_date', 'value_date', 'maturity_date', 'main_component', 'contract_status', 'maker_id', 'maker_stamptime', 'checker_id', 'checker_stamptime', 'seq_number'], 'safe'],
            [['amount', 'settle_account', 'main_component_rate'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ContractMaster::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 150,
            ]
        ]);

        $query->andWhere(['!=', 'contract_status', 'D']);
        $query->andWhere(['!=', 'auth_stat', 'U']);
        $query->andFilterWhere([
            'amount' => $this->amount,
            'booking_date' => $this->booking_date,
            'value_date' => $this->value_date,
            'maturity_date' => $this->maturity_date,
            'settle_account' => $this->settle_account,
            'main_component_rate' => $this->main_component_rate,
        ]);


        $query->andFilterWhere(['like', 'contract_ref_no', $this->contract_ref_no])
            ->andFilterWhere(['like', 'branch', $this->branch])
            ->andFilterWhere(['like', 'product', $this->product])
            ->andFilterWhere(['like', 'product_type', $this->product_type])
            ->andFilterWhere(['like', 'module', $this->module])
            ->andFilterWhere(['like', 'payment_method', $this->payment_method])
            ->andFilterWhere(['like', 'customer_number', $this->customer_number])
            ->andFilterWhere(['like', 'main_component', $this->main_component])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'maker_stamptime', $this->maker_stamptime])
            ->andFilterWhere(['like', 'checker_id', $this->checker_id])
            ->andFilterWhere(['like', 'checker_stamptime', $this->checker_stamptime])
            ->andFilterWhere(['like', 'seq_number', $this->seq_number]);

        return $dataProvider;
    }

    public function lineChart()
    {
        $query=ContractMaster::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $pagination = false;
        $query->select(['count(*) as total','amount','booking_date','customer_number']);
        $query->andWhere(['!=', 'contract_status', 'D']);
        $query->andWhere(['between', 'booking_date', date('Y').'-'.date('m').'-'.'01',  date('Y').'-'.date('m').'-'.'31']);
        $query->groupBy(['booking_date']);
        return $dataProvider;
    }

    public function searchByCustomerNumber($params)
    {
        $query = ContractMaster::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //if (!($this->load($params) && $this->validate())) {
        //  return $dataProvider;
        //}

        $query->andFilterWhere([
            'customer_number' => $params,
        ]);

        //$query->andFilterWhere(['like', 'auth_stat','U']);


        return $dataProvider;
    }

    public function searchByCustomerAccount($params)
    {
        $query = ContractMaster::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //if (!($this->load($params) && $this->validate())) {
        //  return $dataProvider;
        //}

        $query->andFilterWhere([
            'settle_account' => $params,
        ]);

        //$query->andFilterWhere(['like', 'auth_stat','U']);


        return $dataProvider;
    }




public function searchPending()
{
    $query = ContractMaster::find();

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
    ]);


    $query->andFilterWhere([
        'auth_stat' => 'U',

    ]);
    $query->andWhere(['!=', 'contract_status', 'D']);




    return $dataProvider;

}

    public function searchClosed()
    {
        $query = ContractMaster::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $query->andFilterWhere([
            'auth_stat' => 'A','contract_status'=>'L'

        ]);
       




        return $dataProvider;

    }

    public function searchWrittenOff()
    {
        $query = ContractMaster::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $query->andFilterWhere([
            'auth_stat' => 'A',
            'contract_status'=>'WF',

        ]);

        return $dataProvider;

    }

    public function searchAwaitingDisbursement()
    {
        $query = ContractMaster::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $query->andFilterWhere([
            'auth_stat' => 'A',
            'is_disbursed'=>'N'

        ]);


        return $dataProvider;

    }
}
