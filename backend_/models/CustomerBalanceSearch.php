<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CustomerBalance;

/**
 * CustomerBalanceSearch represents the model behind the search form about `backend\models\CustomerBalance`.
 */
class CustomerBalanceSearch extends CustomerBalance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['customer_number', 'last_updated'], 'safe'],
            [['opening_balance', 'current_balance'], 'number'],
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
        $query = CustomerBalance::find();

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
            'opening_balance' => $this->opening_balance,
            'current_balance' => $this->current_balance,
            'last_updated' => $this->last_updated,
        ]);

        $query->andFilterWhere(['like', 'customer_number', $this->customer_number]);

        return $dataProvider;
    }
}
