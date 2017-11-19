<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Saving;

/**
 * SavingSearch represents the model behind the search form about `backend\models\Saving`.
 */
class SavingSearch extends Saving
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['customer_number', 'trn_date', 'fc_period', 'fc_year', 'description', 'payment_method', 'reference', 'status', 'maker_id', 'maker_time', 'auth_stat', 'checker_id', 'checker_time', 'next_pay_date'], 'safe'],
            [['amount'], 'number'],
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
        $query = Saving::find();

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
            'trn_date' => $this->trn_date,
            'amount' => $this->amount,
            'maker_time' => $this->maker_time,
            'checker_time' => $this->checker_time,
            'next_pay_date' => $this->next_pay_date,
        ]);

        $query->andFilterWhere(['like', 'customer_number', $this->customer_number])
            ->andFilterWhere(['like', 'fc_period', $this->fc_period])
            ->andFilterWhere(['like', 'fc_year', $this->fc_year])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'payment_method', $this->payment_method])
            ->andFilterWhere(['like', 'reference', $this->reference])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'auth_stat', $this->auth_stat])
            ->andFilterWhere(['like', 'checker_id', $this->checker_id]);

        return $dataProvider;
    }
}
