<?php

return [
    'id' => 'task',
    'basePath' => realpath(__DIR__ .'/../'),
    'language' => 'ru',
    'defaultRoute' => 'orders/index',
    'components' => [
        'request' => [
            'cookieValidationKey' => 'CxRnuTqev8xKqRje2Ns7eIMK3UYUOm',
            'baseUrl' => ''
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'db' => require_once __DIR__ .'/db.php'
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
];
