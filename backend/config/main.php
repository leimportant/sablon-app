<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'homeUrl' => '/myweb/backdoor',
    'language' => 'en',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'right-menu',
            'mainLayout' => '@app/views/layouts/main.php',
        ],
        'cms' => [
            'class' => 'app\modules\cms\master',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module',
            // enter optional module parameters below - only if you need to  
            // use your own export download action or custom translation 
            // message source
//         'downloadAction' => 'gridview/export/download',
            'i18n' => []
        ],
        'seotools' => [
            'class' => '\jpunanua\seotools\Module',
            'roles' => ['@'], // For setting access levels to the seotools interface.
        ]
    ],
    'components' => [
        'as beforeRequest' => [
            'class' => 'yii\filters\AccessControl',
            'rules' => [
                    [
                    'actions' => ['login', 'error'],
                    'allow' => true,
                ],
                    [
                    'actions' => ['logout', 'index'], // add all actions to take guest to login page
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'basePath' => '@app/messages', // if advanced application, set @frontend/messages
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                    //'main' => 'main.php',
                    ],
                ],
            ],
        ],

        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],
        'as access' => [
            'class' => 'mdm\admin\components\AccessControl',
            'allowActions' => [
                'admin/*', // add or remove allowed actions to this list
            ]
        ],
        'request' => [
            'baseUrl' => '/myweb/backdoor',
            'csrfParam' => '_csrf-backend',
        ],
        'session' => [
            'name' => 'BACKENDSESSID',
            'savePath' => sys_get_temp_dir(),
            'cookieParams' => [
                'path' => '/backdoor',
            ],
        ],
        'seotools' => [
            'class' => 'jpunanua\seotools\Component',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_identity-backend',
                'path' => '/myweb/backdoor',
                'httpOnly' => true
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],
        'as access' => [
            'class' => 'mdm\admin\components\AccessControl',
            'allowActions' => [
                'admin/*', // add or remove allowed actions to this list
            ]
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'languages' => ['en-US', 'en', 'id'],
            'enableDefaultLanguageUrlCode' => true,
            'enableLanguageDetection' => true,
            'enableLanguagePersistence' => false,
            'rules' => [
                'login' => 'site/login',
            ],
        ],
    ],
    'params' => $params,
];
