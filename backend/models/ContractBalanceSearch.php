<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ContractBalance;

/**
 * ContractBalanceSearch represents the model behind the search form about `backend\models\ContractBalance`.
 */
class ContractBalanceSearch extends ContractBalance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['contract_ref_number', 'last_updated'], 'safe'],
            [['contract_amount', 'contract_outstanding'], 'number'],
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
        $query = ContractBalance::find();

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
            'contract_amount' => $this->contract_amount,
            'contract_outstanding' => $this->contract_outstanding,
            'last_updated' => $this->last_updated,
        ]);

        $query->andFilterWhere(['like', 'contract_ref_number', $this->contract_ref_number]);

        return $dataProvider;
    }
}
