<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\HistoryEntry;

/**
 * HistoryEntrySearch represents the model behind the search form about `backend\models\HistoryEntry`.
 */
class HistoryEntrySearch extends HistoryEntry
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['module', 'trn_ref_no', 'trn_dt', 'entry_sr_no', 'ac_no', 'ac_branch', 'event_sr_no', 'event', 'amount_tag', 'drcr_ind', 'trn_code', 'related_customer', 'batch_no', 'product', 'value_dt', 'finacial_year', 'period_code', 'maker_id', 'maker_stamptime', 'checker_id', 'auth_stat', 'delete_stat', 'instrument_code'], 'safe'],
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
    public function search($params)
    {
        $query = HistoryEntry::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'module', $this->module])
            ->andFilterWhere(['like', 'trn_ref_no', $this->trn_ref_no])
            ->andFilterWhere(['like', 'trn_dt', $this->trn_dt])
            ->andFilterWhere(['like', 'entry_sr_no', $this->entry_sr_no])
            ->andFilterWhere(['like', 'ac_no', $this->ac_no])
            ->andFilterWhere(['like', 'ac_branch', $this->ac_branch])
            ->andFilterWhere(['like', 'event_sr_no', $this->event_sr_no])
            ->andFilterWhere(['like', 'event', $this->event])
            ->andFilterWhere(['like', 'amount_tag', $this->amount_tag])
            ->andFilterWhere(['like', 'drcr_ind', $this->drcr_ind])
            ->andFilterWhere(['like', 'trn_code', $this->trn_code])
            ->andFilterWhere(['like', 'related_customer', $this->related_customer])
            ->andFilterWhere(['like', 'batch_no', $this->batch_no])
            ->andFilterWhere(['like', 'product', $this->product])
            ->andFilterWhere(['like', 'value_dt', $this->value_dt])
            ->andFilterWhere(['like', 'finacial_year', $this->finacial_year])
            ->andFilterWhere(['like', 'period_code', $this->period_code])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'maker_stamptime', $this->maker_stamptime])
            ->andFilterWhere(['like', 'checker_id', $this->checker_id])
            ->andFilterWhere(['like', 'auth_stat', $this->auth_stat])
            ->andFilterWhere(['like', 'delete_stat', $this->delete_stat])
            ->andFilterWhere(['like', 'instrument_code', $this->instrument_code]);

        return $dataProvider;
    }
}
