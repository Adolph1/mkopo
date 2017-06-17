<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SystemCharges;

/**
 * SystemChargesSearch represents the model behind the search form about `backend\models\SystemCharges`.
 */
class SystemChargesSearch extends SystemCharges
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'charge'], 'integer'],
            [['charge_name', 'description', 'status', 'maker_id', 'maker_time'], 'safe'],
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
        $query = SystemCharges::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'charge' => $this->charge,
            'maker_time' => $this->maker_time,
        ]);

        $query->andFilterWhere(['like', 'charge_name', $this->charge_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id]);

        return $dataProvider;
    }
}
