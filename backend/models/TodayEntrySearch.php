<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TodayEntry;

/**
 * TodayEntrySearch represents the model behind the search form about `backend\models\TodayEntry`.
 */
class TodayEntrySearch extends TodayEntry
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['module', 'trn_ref_no', 'trn_dt', 'entry_sr_no', 'ac_no', 'ac_branch', 'event_sr_no', 'event', 'amount_tag', 'drcr_ind', 'trn_code', 'related_customer', 'batch_number', 'product', 'value_dt', 'finacial_year', 'period_code', 'maker_id', 'maker_stamptime', 'checker_id', 'auth_stat', 'delete_stat', 'instrument_code'], 'safe'],
            [['amount'], 'number'],
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
    public function search()
    {
        $query = TodayEntry::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //if (!($this->load($params) && $this->validate())) {
        //  return $dataProvider;
        //}

        $query->andFilterWhere([
            'auth_stat' => 'A',
            'trn_dt'=>SystemDate::getCurrentDate(),
        ]);

        //$query->andFilterWhere(['like', 'auth_stat','U']);


        return $dataProvider;
    }
    public function searchunauthorised()
    {
        $query = TodayEntry::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //if (!($this->load($params) && $this->validate())) {
          //  return $dataProvider;
        //}

        $query->andFilterWhere([
            'auth_stat' => 'U',
            'trn_dt'=>SystemDate::getCurrentDate(),
        ]);

        //$query->andFilterWhere(['like', 'auth_stat','U']);


        return $dataProvider;
    }

    public function searchreversed()
    {
        $query = TodayEntry::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //if (!($this->load($params) && $this->validate())) {
        //  return $dataProvider;
        //}

        $query->andFilterWhere([
            'auth_stat' => 'R',
            'trn_dt'=>SystemDate::getCurrentDate(),
        ]);

        //$query->andFilterWhere(['like', 'auth_stat','U']);


        return $dataProvider;
    }
}
