<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ContractAmountReduceDue;

/**
 * ContractAmountReduceDueSearch represents the model behind the search form about `backend\models\ContractAmountReduceDue`.
 */
class ContractAmountReduceDueSearch extends ContractAmountReduceDue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['contract_ref_number', 'due_date', 'account_due', 'customer_number', 'inflow_outflow', 'basis_amount_tag', 'scheduled_linkage', 'amount_prepaid', 'original_due_date', 'status'], 'safe'],
            [['monthly_payment', 'interest_amount_due', 'principal_amount_due', 'balance', 'interest_amount_settled', 'principal_amount_settled', 'adjusted_amount'], 'number'],
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
        $query = ContractAmountReduceDue::find();

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
            'monthly_payment' => $this->monthly_payment,
            'interest_amount_due' => $this->interest_amount_due,
            'principal_amount_due' => $this->principal_amount_due,
            'balance' => $this->balance,
            'interest_amount_settled' => $this->interest_amount_settled,
            'principal_amount_settled' => $this->principal_amount_settled,
            'adjusted_amount' => $this->adjusted_amount,
        ]);

        $query->andFilterWhere(['like', 'contract_ref_number', $this->contract_ref_number])
            ->andFilterWhere(['like', 'due_date', $this->due_date])
            ->andFilterWhere(['like', 'account_due', $this->account_due])
            ->andFilterWhere(['like', 'customer_number', $this->customer_number])
            ->andFilterWhere(['like', 'inflow_outflow', $this->inflow_outflow])
            ->andFilterWhere(['like', 'basis_amount_tag', $this->basis_amount_tag])
            ->andFilterWhere(['like', 'scheduled_linkage', $this->scheduled_linkage])
            ->andFilterWhere(['like', 'amount_prepaid', $this->amount_prepaid])
            ->andFilterWhere(['like', 'original_due_date', $this->original_due_date])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }

    public function searchByReference($params)
    {
        $query = ContractAmountReduceDue::find();

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


    public function searchAwaiting()
    {
        $query = ContractAmountReduceDue::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 150,
            ]
        ]);


        $query->andFilterWhere([
            'status'=>'A'
            //'status'=>'A'
        ]);

        $query->andWhere([
            '<=','due_date',date('Y-m-d')
        ]);



        return $dataProvider;
    }

}
