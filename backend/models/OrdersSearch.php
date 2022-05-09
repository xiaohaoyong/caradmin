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
    public $createtime_end = '';
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mileage', 'interval_mileage'], 'integer'],
            [['orderid', 'customer', 'phone', 'number', 'vin', 'car_model', 'shop', 'worker'], 'safe'],
            [['createtime','createtime_end'], 'string'],

        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        $return = parent::attributeLabels();
        $return ['createtime_end'] = '~';

        return $return;
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
        if($this->createtime){
            $query->andFilterWhere(['>=', 'createtime', $this->createtime]);
        }
        if($this->createtime_end){
            $query->andFilterWhere(['<=', 'createtime', $this->createtime_end]);
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'mileage' => $this->mileage,
            'interval_mileage' => $this->interval_mileage,
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
