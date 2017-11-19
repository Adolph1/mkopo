<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SystemRate;

/**
 * SystemRateSearch represents the model behind the search form about `backend\models\SystemRate`.
 */
class SystemRateSearch extends SystemRate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['user_rate', 'system_rate'], 'number'],
            [['last_updated', 'last_maker'], 'safe'],
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
        $query = SystemRate::find();

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
            'user_rate' => $this->user_rate,
            'system_rate' => $this->system_rate,
            'last_updated' => $this->last_updated,
        ]);

        $query->andFilterWhere(['like', 'last_maker', $this->last_maker]);

        return $dataProvider;
    }
}
