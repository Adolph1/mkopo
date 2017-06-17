<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SystemDates;

/**
 * SystemDatesSearch represents the model behind the search form about `backend\models\SystemDates`.
 */
class SystemDatesSearch extends SystemDates
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['previous_working_day', 'current_working_day', 'next_working_day'], 'safe'],
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
        $query = SystemDates::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'previous_working_day' => $this->previous_working_day,
            'current_working_day' => $this->current_working_day,
            'next_working_day' => $this->next_working_day,
        ]);

        return $dataProvider;
    }
}
