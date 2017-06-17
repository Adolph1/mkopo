<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ContractAmountDue;

/**
 * ContractAmountDueSearch represents the model behind the search form about `backend\models\ContractAmountDue`.
 */
class ContractAmountDueSearch extends ContractAmountDue
{
    /**
     * @inheritdoc
     */
    public $gridColumns;
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['contract_ref_number', 'component', 'due_date', 'currency_amt_due', 'account_due', 'customer_number', 'inflow_outflow', 'basis_amount_tag', 'scheduled_linkage', 'component_type', 'amount_prepaid', 'original_due_date'], 'safe'],
            [['amount_due', 'amount_settled', 'adjusted_amount'], 'number'],
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
        $query = ContractAmountDue::find();
        //->where('product_code = :product_code')
        // ->addParams([':product_code' => $params])
        // ->one();
        $query->Where([
            'contract_ref_number' =>$params,

        ]);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //if (!($this->load($params) && $this->validate())) {
           // return $dataProvider;
       // }



        return $dataProvider;
    }
     public function searchByReference($params)
    {
        $query = ContractAmountDue::find();

        $dataProvider = new ActiveDataProvider([
           'query' => $query,
            'pagination' => [
                'pageSize' => 150,
            ]
        ]);


         $query->andFilterWhere([
            'contract_ref_number' => $params,
        ]);



        return $dataProvider;
    }
}
