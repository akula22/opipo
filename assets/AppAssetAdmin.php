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
class AppAssetAdmin extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        // 'css/admin/css/style.css'
    ];
    public $js = [
        'css/admin/js/app.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\AdminLte',
        'app\assets\Html5shiv'
    ];
}
