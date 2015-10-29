<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    //public $img = '@backend/web/';

    public $css = [
        'js/colorbox/colorbox.css',
        'css/templatemo_style.css',

    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/stickUp.min.js',
        'js/colorbox/jquery.colorbox-min.js',
        'js/templatemo_script.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
