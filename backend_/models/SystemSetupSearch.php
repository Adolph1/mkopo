<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SystemSetup;

/**
 * SystemSetupSearch represents the model behind the search form about `backend\models\SystemSetup`.
 */
class SystemSetupSearch extends SystemSetup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'system_date', 'system_rate', 'system_grace_period'], 'integer'],
            [['system_name', 'system_version'], 'safe'],
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
        $query = SystemSetup::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'system_date' => $this->system_date,
            'system_rate' => $this->system_rate,
            'system_grace_period' => $this->system_grace_period,
        ]);

        $query->andFilterWhere(['like', 'system_name', $this->system_name])
            ->andFilterWhere(['like', 'system_version', $this->system_version]);

        return $dataProvider;
    }
}
