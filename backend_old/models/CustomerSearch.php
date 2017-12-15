<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Customer;

/**
 * CustomerSearch represents the model behind the search form about `backend\models\Customer`.
 */
class CustomerSearch extends Customer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_no', 'identification_id', 'customer_type_id', 'customer_category_id', 'branch_id', 'mod_no'], 'integer'],
            [['first_name', 'middle_name', 'last_name', 'identification_number', 'address', 'mobile_no1', 'mobile_no2', 'email', 'photo', 'record_stat', 'maker_id', 'maker_time'], 'safe'],
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
        $query = Customer::find();

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
            'customer_no' => $this->customer_no,
            'identification_id' => $this->identification_id,
            'customer_type_id' => $this->customer_type_id,
            'customer_category_id' => $this->customer_category_id,
            'branch_id' => $this->branch_id,
            'mod_no' => $this->mod_no,
            'maker_time' => $this->maker_time,
            'record_stat'=> Customer::ACTIVE,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'identification_number', $this->identification_number])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'mobile_no1', $this->mobile_no1])
            ->andFilterWhere(['like', 'mobile_no2', $this->mobile_no2])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id]);

        return $dataProvider;
    }

    public function lineChart()
    {
        $query=Customer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $pagination = false;
        $query->select(['count(*) as customers','branch_id']);
        $query->andWhere(['record_stat'=>'O']);
        $query->groupBy(['branch_id']);
        return $dataProvider;
    }


    public function searchAll()
    {
        $query=Customer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $pagination = false;
        //$query->andWhere(['record_stat'=>'O']);
        return $dataProvider;
    }
}
