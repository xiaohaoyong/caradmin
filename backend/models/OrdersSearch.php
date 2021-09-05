<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Orders;

/**
 * OrdersSearch represents the model behind the search form about `\common\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mileage', 'interval_mileage', 'createtime', 'updatetime'], 'integer'],
            [['orderid', 'customer', 'phone', 'number', 'vin', 'car_model', 'shop', 'worker'], 'safe'],
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
        $query = Orders::find();

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
            'mileage' => $this->mileage,
            'interval_mileage' => $this->interval_mileage,
            'createtime' => $this->createtime,
            'updatetime' => $this->updatetime,
        ]);

        $query->andFilterWhere(['like', 'orderid', $this->orderid])
            ->andFilterWhere(['like', 'customer', $this->customer])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'vin', $this->vin])
            ->andFilterWhere(['like', 'car_model', $this->car_model])
            ->andFilterWhere(['like', 'shop', $this->shop])
            ->andFilterWhere(['like', 'worker', $this->worker]);
        $query->orderBy([self::primaryKey()[0]=>SORT_DESC]);

        return $dataProvider;
    }
}
