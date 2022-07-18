<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2022/7/18
 * Time: 11:01 AM
 */

namespace common\models;


class UploadForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [[['file'], 'file'],];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'file' => '封面图片'
        ];
    }
}