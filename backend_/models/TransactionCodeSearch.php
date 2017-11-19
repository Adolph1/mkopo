<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TransactionCode;

/**
 * TransactionCodeSearch represents the model behind the search form about `backend\models\TransactionCode`.
 */
class TransactionCodeSearch extends TransactionCode
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trn_id', 'mod_no'], 'integer'],
            [['trn_code', 'trn_description', 'maker_id', 'maker_stamptime', 'checker_id', 'checker_stamptime', 'record_stat', 'auth_stat'], 'safe'],
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
        $query = TransactionCode::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'trn_id' => $this->trn_id,
            'mod_no' => $this->mod_no,
        ]);

        $query->andFilterWhere(['like', 'trn_code', $this->trn_code])
            ->andFilterWhere(['like', 'trn_description', $this->trn_description])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'maker_stamptime', $this->maker_stamptime])
            ->andFilterWhere(['like', 'checker_id', $this->checker_id])
            ->andFilterWhere(['like', 'checker_stamptime', $this->checker_stamptime])
            ->andFilterWhere(['like', 'record_stat', $this->record_stat])
            ->andFilterWhere(['like', 'auth_stat', $this->auth_stat]);

        return $dataProvider;
    }
}
