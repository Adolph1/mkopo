<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PaymentType;

/**
 * PaymentTypeSearch represents the model behind the search form about `backend\models\PaymentType`.
 */
class PaymentTypeSearch extends PaymentType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title'], 'safe'],
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
        $query = PaymentType::find();

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
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
