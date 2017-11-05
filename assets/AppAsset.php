<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.css',
        'css/ionicons.css',
        'css/font-awesome.css',
        'css/animations.min.css',
        'css/style-red.css',
    ];
    public $js = [
        'js/source/jquery.fancybox.css',
        "https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js",
        "https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js",
        "js/jquery-1.11.1.js",
        "js/bootstrap.js",
        "js/vegas/jquery.vegas.min.js",
        "js/jquery.easing.min.js",
        "js/source/jquery.fancybox.js",
        "js/jquery.isotope.js",
        "js/appear.min.js",
        "js/animations.min.js",
        "js/custom.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
