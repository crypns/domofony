<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$i18n = require __DIR__ . '/i18n.php';
$language = require __DIR__ . '/language_settings.php';

$config = array_merge($language, [
    'id' => 'app',
    'name' => 'Домофонні системи',

    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@admin' => '@app/modules/admin',
        '@vova07/imperavi/assets' => '@vendor/vova07/yii2-imperavi-widget/src/assets',

    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['user', 'moderator', 'admin'],
        ],
        'formatter' => [
            'currencyCode' => 'UAH',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '6MN-T0hVLs5fEOJuJv37RI6f4YCQJKuc',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\default\User',
            'enableAutoLogin' => true,
        ],
        'telegram' => [
            'class' => 'aki\telegram\Telegram',
//            'botToken' => '5040707194:AAFhxoJaIu3syh6__OmLmghaM3gdzjIeeaw',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            // 'languages' => ['ru' => 'ru-RU'],

            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

                'api/<controller>' => 'admin/api/<controller>',
                'api/<controller>/<action>' => 'admin/api/<controller>/<action>',
                
                'api/<controller>' => 'api/<controller>',
                'api/<controller>/<action>' => 'api/<controller>/<action>',

                '' => 'site/index',
                'login' => 'site/login',
            ],
            'ignoreLanguageUrlPatterns' => [
                // route pattern => url pattern
                // '#^admin/#' => '#^admin/#',
            ],
        ],
        'i18n' => $i18n,
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'liqpay' => [
            'class' => dicr\liqpay\LiqPayModule::class,
            'publicKey' => 'sandbox_i92749472824',
            'privateKey' => 'sandbox_vly1EuFgkoSewqeATw4pl9fNtWZOJpCIqAIaHD8M',
            // опционально обработчик callback с результатами оплаты
            'checkoutHandler' => static function(dicr\liqpay\CheckoutResponse $response) {
                // сохранение результата оплаты
            }
        ]
    ],
    'params' => $params,
]);

if (YII_ENV_DEV) {
    $generators = require __DIR__ . '/gii_generators.php';
    
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '*'],
        
        'generators' => $generators,
    ];
}

return $config;
