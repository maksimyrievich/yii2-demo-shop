<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 08.08.2018
 * Time: 0:09
 */


namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class CatalogAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [
        'js/jquery.accordion.js',
        'js/jquery.cookie.js',
    ];
    public $depends = [
        'frontend\assets\FontAwesomeAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}