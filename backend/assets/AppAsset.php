<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle {

        public $sourcePath = '@webroot/adminlte/dist';
        public $css = [
            'css/AdminLTE.css',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
            'css/AdminLTE.min.css',
            'css/blue.css',
        ];
        public $js = [
            'js/app.js',
            'js/icheck.min.js',
        ];
        public $depends = [
            'yii\web\YiiAsset',
            'yii\bootstrap\BootstrapAsset',
            'yii\bootstrap\BootstrapPluginAsset',
        ];

}
