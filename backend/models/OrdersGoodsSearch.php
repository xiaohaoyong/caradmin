<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OrdersGoods;

/**
 * OrdersGoodsSearch represents the model behind the search form about `\common\models\OrdersGoods`.
 */
class OrdersGoodsSearch extends OrdersGoods
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'goodsid', 'orderid', 'num'], 'integer'],
            [['goods_name', 'remarks'], 'safe'],
            [['price', 'total'], 'number'],
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
        $query = OrdersGoods::find();

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
            'goodsid' => $this->goodsid,
            'orderid' => $this->orderid,
            'price' => $this->price,
            'num' => $this->num,
            'total' => $this->total,
        ]);

        $query->andFilterWhere(['like', 'goods_name', $this->goods_name])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);
        $query->orderBy([self::primaryKey()[0]=>SORT_DESC]);

        return $dataProvider;
    }
}
