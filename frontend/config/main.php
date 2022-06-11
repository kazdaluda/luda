<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log',
        'common\bootstrap\SetUp',
        'frontend\bootstrap\SetUp',
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'baseUrl'=>'',
            'csrfParam' => '_csrf-frontend',
            'cookieValidationKey'=>$params['cookieValidationKey']
        ],
        'user' => [
            'identityClass' => 'shop\entities\User\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity', 'httpOnly' => true,
                //'domain'=>$params['cookieDomain'],
            ],
            'loginUrl'=>['auth/auth/login']
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced',
            'cookieParams'=>[
               // 'domain'=>$params['cookieDomain'],
                'httpOnly' => true,
            ]
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


        'backendUrlManager'=> require __DIR__ . '/../../backend/config/urlManager.php',
        'frontendUrlManager'=> require __DIR__ .'/urlManager.php',
        'urlManager' => function(){
            return yii::$app->get('frontendUrlManager');
        },
    ],
    'params' => $params,
];