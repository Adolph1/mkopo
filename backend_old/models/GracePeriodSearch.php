<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\GracePeriod;

/**
 * GracePeriodSearch represents the model behind the search form about `backend\models\GracePeriod`.
 */
class GracePeriodSearch extends GracePeriod
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'period'], 'integer'],
            [['maker_id', 'maker_time'], 'safe'],
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
        $query = GracePeriod::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'period' => $this->period,
            'maker_time' => $this->maker_time,
        ]);

        $query->andFilterWhere(['like', 'maker_id', $this->maker_id]);

        return $dataProvider;
    }
}
