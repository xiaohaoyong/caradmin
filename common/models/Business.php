<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "business".
 *
 * @property int $id
 * @property string $name 商户名称
 * @property int $phone 商户联系电话
 * @property int $starttime 开始时间
 * @property int $endtime 结束时间
 */
class Business extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'business';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone'], 'integer'],
            [['starttime','endtime'],'date','format' =>'php:Y-m-d'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商户名称',
            'phone' => '商户联系电话',
            'starttime' => '开始时间',
            'endtime' => '结束时间',
        ];
    }
}
