<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ContractNormalRepayment;

/**
 * ContractNormalRepaymentSearch represents the model behind the search form about `backend\models\ContractNormalRepayment`.
 */
class ContractNormalRepaymentSearch extends ContractNormalRepayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'month_factor'], 'integer'],
            [['contract_ref_number', 'due_date'], 'safe'],
            [['contract_amount', 'interest', 'contract_outstanding', 'customer_installment', 'balance', 'expected_installment'], 'number'],
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
        $query = ContractNormalRepayment::find();
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
    public function searchdue($params)
    {
        $query = ContractNormalRepayment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // if (!($this->load($params) && $this->validate())) {
        //    return $dataProvider;
        //}
        $query->andFilterWhere([
            'contract_ref_number' => $params,
            //'amount_settled'=>$this->amount_due,
        ]);


        //$query->andFilterWhere(['like', 'product_code', $this->product_code]);

        return $dataProvider;
    }

}
