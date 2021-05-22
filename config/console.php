<?php

return [
    'id' => 'crmapp-console',
    'basePath' => dirname(__DIR__),
    'components' => [
        'db' => require_once __DIR__ .'/db.php'
    ]
];