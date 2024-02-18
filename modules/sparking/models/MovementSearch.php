<?php

namespace app\modules\sparking\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\sparking\models\Movement;

/**
 * MovementSearch represents the model behind the search form of `app\modules\sparking\models\Movement`.
 */
class MovementSearch extends Movement
{
    public $totalSum;
    public $check_out_desde;
    public $check_out_hasta;
    public $is_open;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'check_in_user_id', 'check_out_user_id', 'is_open'], 'integer'],
            [['plate', 'check_in', 'check_out', 'time_elapsed'], 'safe'],
            [['check_out_desde', 'check_out_hasta'], 'safe'],
            [['payment_value'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plate' => 'Placa del vehiculo',
            'type_id' => 'Tipo de vehiculo',
            'check_in' => 'Fecha de llegada',
            'check_in_user_id' => 'Usuario llegada',
            'check_out' => 'Fecha de salida',
            'check_out_user_id' => 'Usuario salida',
            'time_elapsed' => 'Tiempo transcurrido',
            'payment_value' => 'Valor cobro',
            'check_out_desde' => 'Fecha (desde)',
            'check_out_hasta' => 'Fecha (hasta)',
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
        $query = Movement::find();

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
            // 'plate' => $this->plate,
            'type_id' => $this->type_id,
            'check_in' => $this->check_in,
            'check_in_user_id' => $this->check_in_user_id,
            // 'check_out' => $this->check_out,
            'check_out_user_id' => $this->check_out_user_id,
            'payment_value' => $this->payment_value,
        ]);

        $query->andFilterWhere(['like', 'plate', $this->plate]);
        //     ->andFilterWhere(['like', 'time_elapsed', $this->time_elapsed]);


        // $query->andFilterWhere(['like', 'plate', $this->plate])
        //     ->andFilterWhere(['like', 'time_elapsed', $this->time_elapsed])
        //     ->andWhere(['not', ['check_out_user_id' => null]]);

        if (!empty($this->check_out_desde) && !empty($this->check_out_hasta)) {
            $query->andFilterWhere(['between', 'check_out', "{$this->check_out_desde}", "{$this->check_out_hasta}"]);
        }
        // else $query->andFilterWhere(['check_out' => $this->check_out]);

        $this->totalSum = $query->sum('payment_value'); // this works very fast

        return $dataProvider;
    }

    public function searchNull($params)
    {
        $query = Movement::find();

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

    function setCheckOutDesde($t) {
        $this->check_out_desde = $t;
    }
    function setCheckOutHasta($t) {
        $this->check_out_hasta = $t;
    }
}