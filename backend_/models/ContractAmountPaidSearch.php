<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ContractAmountPaid;

/**
 * ContractAmountPaidSearch represents the model behind the search form about `backend\models\ContractAmountPaid`.
 */
class ContractAmountPaidSearch extends ContractAmountPaid
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['contract_ref_no', 'component', 'due_date', 'paid_date', 'currency_settled', 'account_settled', 'customer_number', 'inflow_outflow', 'amount_prepaid', 'payment_status', 'accounting_passed', 'message_sent'], 'safe'],
            [['amount_settled', 'base_amount'], 'number'],
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
        $query = ContractAmountPaid::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'amount_settled' => $this->amount_settled,
            'base_amount' => $this->base_amount,
        ]);

        $query->andFilterWhere(['like', 'contract_ref_no', $this->contract_ref_no])
            ->andFilterWhere(['like', 'component', $this->component])
            ->andFilterWhere(['like', 'due_date', $this->due_date])
            ->andFilterWhere(['like', 'paid_date', $this->paid_date])
            ->andFilterWhere(['like', 'currency_settled', $this->currency_settled])
            ->andFilterWhere(['like', 'account_settled', $this->account_settled])
            ->andFilterWhere(['like', 'customer_number', $this->customer_number])
            ->andFilterWhere(['like', 'inflow_outflow', $this->inflow_outflow])
            ->andFilterWhere(['like', 'amount_prepaid', $this->amount_prepaid])
            ->andFilterWhere(['like', 'payment_status', $this->payment_status])
            ->andFilterWhere(['like', 'accounting_passed', $this->accounting_passed])
            ->andFilterWhere(['like', 'message_sent', $this->message_sent]);

        return $dataProvider;
    }
}
