<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SmsLog;

/**
 * SmsLogSearch represents the model behind the search form about `backend\models\SmsLog`.
 */
class SmsLogSearch extends SmsLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['created_dt', 'to', 'content'], 'safe'],
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
        $query = SmsLog::find();

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
            'created_dt' => $this->created_dt,
        ]);

        $query->andFilterWhere(['like', 'to', $this->to])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }




    public function lineChart()
    {
        $query=SmsLog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $pagination = false;
        $query->select(['count(*) as total','created_dt','to',]);
        $query->andWhere(['between', 'created_dt', date('Y').'-'.date('m').'-'.'01',  date('Y').'-'.date('m').'-'.'31']);
        $query->groupBy(['created_dt']);
        return $dataProvider;
    }


    public function PieChart()
    {
        $query=SmsLog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $pagination = false;
       $query->select(['count(*) as total','created_dt','to',]);
        $query->andWhere(['between', 'created_dt', date('Y').'-'.date('m').'-'.'01',  date('Y').'-'.date('m').'-'.'31']);
        $query->groupBy(['created_dt']);
        return $dataProvider;
    }
}
