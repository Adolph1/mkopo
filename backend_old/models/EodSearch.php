<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Eod;

/**
 * EodSearch represents the model behind the search form about `backend\models\Eod`.
 */
class EodSearch extends Eod
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['process_function', 'process_description', 'status', 'starttime', 'endtime'], 'safe'],
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
        $query = Eod::find();

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
        ]);

        $query->andFilterWhere(['like', 'process_function', $this->process_function])
            ->andFilterWhere(['like', 'process_description', $this->process_description])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'starttime', $this->starttime])
            ->andFilterWhere(['like', 'endtime', $this->endtime]);

        return $dataProvider;
    }


    public function searchToday()
    {
        $query = Eod::find();


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andFilterWhere(['like', 'starttime', SystemDate::getCurrentDate()]);


        return $dataProvider;
    }
}
