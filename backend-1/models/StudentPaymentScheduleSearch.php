<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\StudentPaymentSchedule;

/**
 * StudentPaymentScheduleSearch represents the model behind the search form about `backend\models\StudentPaymentSchedule`.
 */
class StudentPaymentScheduleSearch extends StudentPaymentSchedule
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'payment_type_id', 'year_of_study'], 'integer'],
            [['student_reg', 'last_update'], 'safe'],
            [['amount', 'amount_settled'], 'number'],
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
        $query = StudentPaymentSchedule::find();

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
            'payment_type_id' => $this->payment_type_id,
            'amount' => $this->amount,
            'year_of_study' => $this->year_of_study,
            'amount_settled' => $this->amount_settled,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['like', 'student_reg', $this->student_reg]);

        return $dataProvider;
    }
}
