<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Guarantor;

/**
 * GuarantorSearch represents the model behind the search form about `backend\models\Guarantor`.
 */
class GuarantorSearch extends Guarantor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'identification'], 'integer'],
            [['name', 'phone_number', 'contract_ref_number', 'identification_number', 'related_customer', 'maker_id', 'maker_time'], 'safe'],
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
        $query = Guarantor::find();

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
            'identification' => $this->identification,
            'maker_time' => $this->maker_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'contract_ref_number', $this->contract_ref_number])
            ->andFilterWhere(['like', 'identification_number', $this->identification_number])
            ->andFilterWhere(['like', 'related_customer', $this->related_customer])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id]);

        return $dataProvider;
    }

    public function searchByReference($params)
    {
        $query = Guarantor::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 150,
            ]
        ]);


        $query->andFilterWhere([
            'contract_ref_number' => $params,
        ]);



        return $dataProvider;
    }
}
