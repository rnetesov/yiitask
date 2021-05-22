<?php

namespace app\assets;


use yii\web\AssetBundle;
use yii\web\View;


class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/app.css'
    ];
    public $js = [
    ];

    public $jsOptions = [
        'position' => View::POS_HEAD
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}