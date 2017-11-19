<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ContractAmount;

/**
 * ContractAmountSearch represents the model behind the search form about `backend\models\ContractAmount`.
 */
class ContractAmountSearch extends ContractAmount
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['contract_ref_number', 'due_date', 'account_due', 'customer_number'], 'safe'],
            [['amount_due', 'amount_settled'], 'number'],
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
        $query = ContractAmount::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'amount_due' => $this->amount_due,
            'amount_settled' => $this->amount_settled,
        ]);

        $query->andFilterWhere(['like', 'contract_ref_number', $this->contract_ref_number])
            ->andFilterWhere(['like', 'due_date', $this->due_date])
            ->andFilterWhere(['like', 'account_due', $this->account_due])
            ->andFilterWhere(['like', 'customer_number', $this->customer_number]);

        return $dataProvider;
    }
    public function searchdue1($params)
    {
        $query = ContractAmount::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // if (!($this->load($params) && $this->validate())) {
        //    return $dataProvider;
        //}
        $query->andFilterWhere([
            'contract_ref_number' => $params,
            //'amount_settled'=>$this->amount_due,
        ]);


        //$query->andFilterWhere(['like', 'product_code', $this->product_code]);

        return $dataProvider;
    }
}
