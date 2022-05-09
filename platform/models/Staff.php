<?php

namespace platform\models;

use Yii;

/**
 * This is the model class for table "staff".
 *
 * @property int $id
 * @property string $name 姓名
 * @property int $bus_id 商户
 */
class Staff extends \common\models\Staff
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bus_id'], 'integer'],
            [['name'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'bus_id' => '商户',
        ];
    }
    public function beforeSave($insert)
    {
        $this->bus_id=Yii::$app->user->identity->bus_id;
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}