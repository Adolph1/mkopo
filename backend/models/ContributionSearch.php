<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Contribution;

/**
 * ContributionSearch represents the model behind the search form about `backend\models\Contribution`.
 */
class ContributionSearch extends Contribution
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'payment_type', 'contribution_type'], 'integer'],
            [['trn_ref_no', 'trn_dt', 'payment_date', 'customer_number', 'period', 'financial_year', 'reference', 'description', 'auth_stat', 'maker_id', 'maker_time', 'checker_id', 'checker_time'], 'safe'],
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
        $query = Contribution::find();

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
            'payment_date' => $this->payment_date,
            'payment_type' => $this->payment_type,
            'amount' => $this->amount,
            'contribution_type' => $this->contribution_type,
            'maker_time' => $this->maker_time,
            'checker_time' => $this->checker_time,
        ]);

        $query->andFilterWhere(['like', 'trn_ref_no', $this->trn_ref_no])
            ->andFilterWhere(['like', 'customer_number', $this->customer_number])
            ->andFilterWhere(['like', 'period', $this->period])
            ->andFilterWhere(['like', 'financial_year', $this->financial_year])
            ->andFilterWhere(['like', 'reference', $this->reference])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'auth_stat', $this->auth_stat])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'checker_id', $this->checker_id]);

        return $dataProvider;
    }
}
