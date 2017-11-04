<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ContractPayment;

/**
 * ContractPaymentSearch represents the model behind the search form about `backend\models\ContractPayment`.
 */
class ContractPaymentSearch extends ContractPayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'transaction_type'], 'integer'],
            [['trn_dt', 'contract_ref_number', 'description', 'maker_id', 'maker_time', 'auth_stat', 'checker_time'], 'safe'],
            [['debit', 'credit', 'balance', 'checker_id'], 'number'],
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
        $query = ContractPayment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'trn_dt' => $this->trn_dt,
            'transaction_type' => $this->transaction_type,
            'debit' => $this->debit,
            'credit' => $this->credit,
            'balance' => $this->balance,
            'maker_time' => $this->maker_time,
            'checker_id' => $this->checker_id,
            'checker_time' => $this->checker_time,
        ]);

        $query->andFilterWhere(['like', 'contract_ref_number', $this->contract_ref_number])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'auth_stat', $this->auth_stat]);

        return $dataProvider;
    }

    public function searchByReference($params)
    {
        $query = ContractPayment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 150,
            ]
        ]);


        $query->andFilterWhere([
            'contract_ref_number' => $params,
            //'status'=>'A'
        ]);



        return $dataProvider;
    }
}
