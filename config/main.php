<?php
$params = require(__DIR__ . '/params.php');



$config = [
    'id' => 'basic',
    'name' => 'OpipO.ru',
    'version' => '1.0',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        // 'app\modules\pm\Bootstrap',
    ],
    'timezone' => 'Europe/Moscow',
    'as locale'=>[
        'class'=>'app\components\LocaleBehavior'
    ],
    'modules' => [
        'site' => [
            'class' => 'app\modules\site\Module',
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
        ],
       
        'pages' => [
            'class' => 'app\modules\pages\Module',
        ],
        'backend' => [
            'class' => 'app\modules\backend\Module',
            'layout' =>'main',
        ],
        'paper' => [
            'class' => 'app\modules\paper\Module',
            'layout' =>'main',
        ],
        'paper2' => [
            'class' => 'app\modules\paper2\Module',
            'layout' =>'main',
        ],
        'paper3' => [
            'class' => 'app\modules\paper3\Module',
            'layout' =>'main',
        ],
    ],
    'components' => [
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'datetimeFormat' => 'd-M-Y H:i:s',
            'dateFormat' => 'long',
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'vkontakte' => [
                    'class' => 'yii\authclient\clients\VKontakte',
                    'clientId' => '1938681',
                    'clientSecret' => 'hm4q5m4Zn9crGnlzFHbh',
                    'scope' => 'email',
                ],
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '1563452517221394',
                    'clientSecret' => '1127f18839850758ccc38fcd0db3ebb3',
                    'authUrl' => 'https://www.facebook.com/dialog/oauth?display=popup',
                    'scope' => 'email',
                ],
                'yandex' => [
                    'class' => 'yii\authclient\clients\YandexOAuth',
                    'clientId' => 'dfdd4407c7ea4f37aa4011bc6ff880a9',
                    'clientSecret' => '6c54fd3ecee7497f9e21eb48afe85282',
                    'scope' => 'email',
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'LtZwZbAL1Z0syBA-QaGdbP0xHQToujhn',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => ['user', 'moder', 'admin'],
          
        ],
        'VarDumper' => [
            'class' => 'app\components\VarDumper',
        ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => '/login',
        ],
        
        'errorHandler' => [
            'errorAction' => 'site/default/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => YII_DEBUG ? true : false,
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
        'keyStorage' => [
            'class' => 'app\common\components\keyStorage\KeyStorage'
        ],
        'i18n' => require(__DIR__ . '/i18n.php'),
        'db' => require(__DIR__ . '../../db.php'),
        'urlManager' => require(__DIR__ . '/url.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
    $config['components']['db'] = require(__DIR__ . '/db.local');
}

return $config;