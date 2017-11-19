<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MaturedLoanCharge;

/**
 * MaturedLoanChargeSearch represents the model behind the search form about `backend\models\MaturedLoanCharge`.
 */
class MaturedLoanChargeSearch extends MaturedLoanCharge
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'months'], 'integer'],
            [['contract_ref_number', 'matured_date', 'last_update'], 'safe'],
            [['charge_amount'], 'number'],
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
        $query = MaturedLoanCharge::find();

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
            'matured_date' => $this->matured_date,
            'charge_amount' => $this->charge_amount,
            'months' => $this->months,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['like', 'contract_ref_number', $this->contract_ref_number]);

        return $dataProvider;
    }
}
