<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "goods_category".
 *
 * @property int $id
 * @property int $cat_id 分类
 * @property int $goods_id 商品
 */
class GoodsCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'goods_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_id', 'goods_id'], 'required'],
            [['cat_id', 'goods_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_id' => 'Cat ID',
            'goods_id' => 'Goods ID',
        ];
    }
}
