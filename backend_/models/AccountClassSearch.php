<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AccountClass;

/**
 * AccountClassSearch represents the model behind the search form about `backend\models\AccountClass`.
 */
class AccountClassSearch extends AccountClass
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['acc_class', 'description', 'dormancy', 'record_status', 'maker_id', 'maker_stamptime', 'checker_id', 'check_stamptime', 'auth_status'], 'safe'],
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
        $query = AccountClass::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'acc_class', $this->acc_class])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'dormancy', $this->dormancy])
            ->andFilterWhere(['like', 'record_status', $this->record_status])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'maker_stamptime', $this->maker_stamptime])
            ->andFilterWhere(['like', 'checker_id', $this->checker_id])
            ->andFilterWhere(['like', 'check_stamptime', $this->check_stamptime])
            ->andFilterWhere(['like', 'auth_status', $this->auth_status]);

        return $dataProvider;
    }
}
