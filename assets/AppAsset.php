<?php

namespace app\assets;

use Yii;
use yii\web\AssetBundle;
use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Json;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/basic-styles.css',
        'css/header-footer.css',
        'css/house.css',
        'css/order.css',
        'css/site.css',
          'css/styles.css',
        'fonts/stylesheet.css',
    ];
    public $js = [
        'js/app.js',

         //'js/jquery-3.6.0.min.js',
        'js/slick.min.js',
        'js/scripts.js',
        'js/rebuild.js',
        'js/cart.js',
    ];


    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\web\JqueryAsset',
        'app\assets\AngularAsset',
        'kartik\icons\FontAwesomeAsset',
    ];

    public function init() {
        // In JS use: yiiGlobal.test, etc.
        $options = [
            'test' => Url::to(['test/test']),

            'authKey' => Yii::$app->user->identity?->access_token,
        ];
        Yii::$app->view->registerJs(
            "const yiiGlobal = " . Json::htmlEncode($options).";",
            View::POS_HEAD,
            'yiiGlobal'
        );
    }
}
