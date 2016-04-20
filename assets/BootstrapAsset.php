<?php
/**
 * Created by PhpStorm.
 * User: ё
 * Date: 16.04.2016
 * Time: 10:02
 */

namespace app\assets;
use yii\web\AssetBundle;

class BootstrapAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://yastatic.net/bootstrap/3.3.6/css/bootstrap.min.css',
        'css/bootstrap-switch.min.css',
    ];
    public $js = [
        'https://yastatic.net/bootstrap/3.3.6/js/bootstrap.min.js',
        'js/bootstrap-switch.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}