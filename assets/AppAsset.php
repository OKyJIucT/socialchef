<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';

    public $sourcePath = '@vendor/twbs/bootstrap/dist';

    public $css = [
        '/css/theme.css',
        'css/bootstrap.min.css',
    ];

    public $js = [
        '//www.atlasestateagents.co.uk/javascript/tether.min.js',
        'js/bootstrap.min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
