<?php

namespace backend\assets;

use yii\web\AssetBundle;

class AdminLtePluginAsset extends AssetBundle {

    public $sourcePath = '@webroot/adminlte/dist';
    public $js = [
        'js/jquery.slimscroll.min.js',
        'js/fastclick.js',
        'js/app.min.js',
        'js/adminlte.min.js',
        'js/demo.js',
        'js/app.js',
        'js/moment.js',
        'js/bootstrap-multiselect.js',
        'js/daterangepicker.js',
        'js/croppie.js',
        'js/bootstrap-tokenfield.js',
        'js/bootstrap-datepicker.js',
        'js/locationpicker.jquery.js',
        'js/bootstrap-timepicker.min.js',
    ];
    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
        'css/AdminLTE.min.css',
        'css/developer.css',
        'css/skins/_all-skins.min.css',
        'css/bootstrap-multiselect.css',
        'css/croppie.css',
        'css/bootstrap-tokenfield.css',
        'css/bootstrap-timepicker.min.css',
        "https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
//        'dmstr\web\AdminLteAsset',
    ];

}
