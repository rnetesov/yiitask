<?php

use yii\web\Application;

ini_set('display_errors', true);
define('YII_DEBUG', true);

require_once __DIR__ .'/../vendor/autoload.php';
require_once __DIR__ .'/../vendor/yiisoft/yii2/Yii.php';

require_once __DIR__. '/../config/functions.php';

$config = require_once __DIR__ . '/../config/web.php';

(new Application($config))->run();
