<?php
return [
    'language' => 'zh-CN',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'modules' => [
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '@webroot/uploadfolder',
            'uploadUrl' => '@web/uploadfolder',
            'imageAllowExtensions'=>['jpg','png','gif']
        ],
    ],
];
