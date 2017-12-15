<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Account;

/**
 * AccountSearch represents the model behind the search form about `backend\models\Account`.
 */
class AccountSearch extends Account
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_code', 'ac_desc', 'account_class', 'ac_stat_no_dr', 'ac_stat_no_cr', 'ac_stat_no_block', 'ac_stat_stop_pay', 'ac_stat_dormant', 'acc_open_date', 'dormancy_date', 'acc_status', 'maker_id', 'maker_stamptime', 'checker_id', 'check_stamptime', 'auth_stat'], 'safe'],
            [['cust_ac_no', 'cust_no', 'dormancy_days', 'mod_no'], 'integer'],
            [['ac_opening_bal'], 'number'],
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
        $query = Account::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'cust_ac_no' => $this->cust_ac_no,
            'cust_no' => $this->cust_no,
            'ac_opening_bal' => $this->ac_opening_bal,
            'dormancy_date' => $this->dormancy_date,
            'dormancy_days' => $this->dormancy_days,
            'mod_no' => $this->mod_no,
        ]);

        $query->andFilterWhere(['like', 'branch_code', $this->branch_code])
            ->andFilterWhere(['like', 'ac_desc', $this->ac_desc])
            ->andFilterWhere(['like', 'account_class', $this->account_class])
            ->andFilterWhere(['like', 'ac_stat_no_dr', $this->ac_stat_no_dr])
            ->andFilterWhere(['like', 'ac_stat_no_cr', $this->ac_stat_no_cr])
            ->andFilterWhere(['like', 'ac_stat_no_block', $this->ac_stat_no_block])
            ->andFilterWhere(['like', 'ac_stat_stop_pay', $this->ac_stat_stop_pay])
            ->andFilterWhere(['like', 'ac_stat_dormant', $this->ac_stat_dormant])
            ->andFilterWhere(['like', 'acc_open_date', $this->acc_open_date])
            ->andFilterWhere(['like', 'acc_status', $this->acc_status])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'maker_stamptime', $this->maker_stamptime])
            ->andFilterWhere(['like', 'checker_id', $this->checker_id])
            ->andFilterWhere(['like', 'check_stamptime', $this->check_stamptime])
            ->andFilterWhere(['like', 'auth_stat', $this->auth_stat]);

        return $dataProvider;
    }
}
