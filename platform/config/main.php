<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-platform',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'platform\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'name'=>'管理平台',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-platform',
        ],
        'user' => [
            'identityClass' => 'platform\models\AdminBusiness',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-platform', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-platform',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];
