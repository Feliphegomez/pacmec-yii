<?php

namespace app\modules\sparking\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\sparking\models\Movements;

/**
 * MovementsSearch represents the model behind the search form of `app\models\Movements`.
 */
class MovementsSearch extends Movements
{
    public $check_out_hasta;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'check_in_user_id', 'check_out_user_id'], 'integer'],
            [['plate', 'check_in', 'check_out', 'time_elapsed'], 'safe'],
            [['check_in_hasta', 'check_out_hasta'], 'safe'],
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
        $query = Movements::find();

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
            'check_in' => $this->check_in,
            'check_in_user_id' => $this->check_in_user_id,
            'check_out' => $this->check_out,
            'check_out_user_id' => $this->check_out_user_id,
            'payment_value' => $this->payment_value,
        ]);

        $query->andFilterWhere(['like', 'plate', $this->plate])
            ->andFilterWhere(['like', 'time_elapsed', $this->time_elapsed]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchPays($params)
    {
        $query = Movements::find();

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
            // 'check_in' => $this->check_in,
            'check_in_user_id' => $this->check_in_user_id,
            // 'check_out' => $this->check_out,
            'check_out_user_id' => $this->check_out_user_id,
            'payment_value' => $this->payment_value,
        ]);

        $query->andFilterWhere(['like', 'plate', $this->plate])
            ->andFilterWhere(['like', 'time_elapsed', $this->time_elapsed])
            ->andWhere(['not', ['check_out_user_id' => null]]);

        if (!empty($this->check_out) && !empty($this->check_out_hasta)) 
            $query->andFilterWhere(['between', 'check_out', "{$this->check_out}", "{$this->check_out_hasta}"]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchNull($params)
    {
        $query = Movements::find();

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
            'check_in' => $this->check_in,
            'check_in_user_id' => $this->check_in_user_id,
            'check_out' => $this->check_out,
            'check_out_user_id' => $this->check_out_user_id,
            'payment_value' => $this->payment_value,
        ]);

        $query->andFilterWhere(['like', 'plate', $this->plate])
            ->andFilterWhere(['like', 'time_elapsed', $this->time_elapsed])
            ->andWhere(['check_out_user_id' => null]);

        return $dataProvider;
    }
}