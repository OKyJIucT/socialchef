<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic_socialchef',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru_RU',
    'charset' => 'UTF-8',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'permit' => [
            'class' => 'developeruz\db_rbac\Yii2DbRbac',
            'params' => [
                'userClass' => 'app\models\Users'
            ]
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'IWd8UHmdd_F993WGU4FWoscVKLTS_SVa',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
            'loginUrl' => ['site/login']
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                [
                    'pattern' => '',
                    'route' => 'site/index',
                    'suffix' => ''
                ],
                [
                    'pattern' => '<action:(login|logout|reg)>',
                    'route' => 'site/<action>',
                    'suffix' => ''
                ],
                [
                    'pattern' => '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>',
                    'route' => '<module>/<controller>/<action>',
                    'suffix' => ''
                ],
                [
                    'pattern' => '<module:\w+>/<controller:\w+>/<action:\w+>',
                    'route' => '<module>/<controller>/<action>',
                    'suffix' => ''
                ],
                [
                    'pattern' => '<module:\w+>',
                    'route' => '<module>/default/index',
                    'suffix' => ''
                ],
                [
                    'pattern' => '<controller>/<action>/<id:\d+>',
                    'route' => '<controller>/<action>',
                    'suffix' => ''
                ],
                [
                    'pattern' => '<controller>/<action>',
                    'route' => '<controller>/<action>',
                    'suffix' => ''
                ],
                [
                    'pattern' => '<controller>',
                    'route' => '<controller>/index',
                    'suffix' => ''
                ],
            ]
        ],
        'assetManager' => [
            'appendTimestamp' => true,
            'bundles' => [
//                'yii\bootstrap\BootstrapAsset' => [
//                    'css' => ['https://yastatic.net/bootstrap/3.3.6/js/bootstrap.min.css'],
//                    'js' => ['https://yastatic.net/bootstrap/3.3.6/js/bootstrap.min.js'],
//                ],
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,   // do not publish the bundle
                    'js' => [
                        'https://yastatic.net/jquery/2.2.3/jquery.min.js',
                    ]
                ]
            ]
        ],
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'app\models\ReCaptcha',
            'siteKey' => '6LfkVAsTAAAAAA8qCya2QRj6cm_FlMSZwcLL8eBt',
            'secret' => '6LfkVAsTAAAAAB7_So7CeohfI00dbJymtfo2Rx_V',
        ],
        /*
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'companie' => 'app.php',
                    ],
                ],
            ],
        ],*/
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '185.37.193.142', '193.178.187.221']
    ];
}

return $config;
