<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders_goods".
 *
 * @property int $id
 * @property int $goodsid 商品ID
 * @property int $orderid 订单ID
 * @property string $goods_name 商品名称
 * @property float $price 单价
 * @property int $num 数量
 * @property float $total 总价
 * @property string $remarks 备注
 */
class OrdersGoods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders_goods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['goods_name', 'price', 'num', 'total', 'remarks'], 'required'],
            [['id', 'goodsid', 'orderid', 'num'], 'integer'],
            [['price', 'total'], 'number'],
            [['remarks'], 'string'],
            [['goods_name'], 'string', 'max' => 50],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goodsid' => '商品ID',
            'orderid' => '订单ID',
            'goods_name' => '商品名称',
            'price' => '单价',
            'num' => '数量',
            'total' => '总价',
            'remarks' => '备注',
        ];
    }
}
