<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AdminLteAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugins/adminlte/css/AdminLTE.min.css',
        'plugins/adminlte/css/_all-skins.min.css',
        'plugins/adminlte/css/bootstrap.css',
        'plugins/foxholder/src/foxholder-styles.css',
    ];
    public $js = [
        'plugins/foxholder/static/scripts/prism.js',
        'plugins/foxholder/src/foxholder.js',
        'plugins/foxholder/static/scripts/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
