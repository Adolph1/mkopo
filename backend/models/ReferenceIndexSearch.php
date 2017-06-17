<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ReferenceIndex;

/**
 * ReferenceIndexSearch represents the model behind the search form about `backend\models\ReferenceIndex`.
 */
class ReferenceIndexSearch extends ReferenceIndex
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['index_no', 'product', 'full_reference', 'status'], 'safe'],
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
        $query = ReferenceIndex::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'index_no', $this->index_no])
            ->andFilterWhere(['like', 'product', $this->product])
            ->andFilterWhere(['like', 'full_reference', $this->full_reference])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
