<?php

namespace app\modules\sparking\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\sparking\models\Plan;

/**
 * PlanSearch represents the model behind the search form of `app\modules\sparking\models\Plan`.
 */
class PlanSearch extends Plan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'membership_id'], 'integer'],
            [['plate', 'date_start', 'date_end'], 'safe'],
            [['payment_value'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Plan::find();

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
            'type_id' => $this->type_id,
            'membership_id' => $this->membership_id,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'payment_value' => $this->payment_value,
        ]);

        $query->andFilterWhere(['like', 'plate', $this->plate]);

        return $dataProvider;
    }
}
