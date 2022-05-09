<?php

namespace platform\models;

use platform\models\Goods;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * GoodsSearch represents the model behind the search form about `\common\models\Goods`.
 */
class GoodsSearch extends Goods
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'stock', 'createtime', 'updatetime'], 'integer'],
            [['name', 'goods_model', 'make', 'car_model', 'remarks'], 'safe'],
            [['price'], 'number'],
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
        $query = Goods::find();

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
            'price' => $this->price,
            'stock' => $this->stock,
            'createtime' => $this->createtime,
            'updatetime' => $this->updatetime,
        ]);
        $query->where(['bus_id'=>Yii::$app->user->identity->bus_id]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'goods_model', $this->goods_model])
            ->andFilterWhere(['like', 'make', $this->make])
            ->andFilterWhere(['like', 'car_model', $this->car_model])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);
        $query->orderBy([self::primaryKey()[0]=>SORT_DESC]);

        return $dataProvider;
    }
}
