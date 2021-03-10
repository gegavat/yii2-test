<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/jquery.contextMenu.min.css',
        'css/site.css',
        'css/apple.css',
    ];
    public $js = [
        'js/jquery.contextMenu.min.js',
        'js/jquery.ui.position.js',
        'js/apple.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
