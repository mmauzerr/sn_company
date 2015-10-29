<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [ 'class' => 'yii\web\UrlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<controller:\w+\-\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<id:\d+>/<slug:[A-Za-z0-9\-_\.\/]+>' => '<controller>/view',
            ],
        ],
        'i18n' => [
            'class'=> uran1980\yii\modules\i18n\components\I18N::className(),
            'languages' => ['en'],
            'sourcePath' => [
                __DIR__ . '/../../frontend',
                __DIR__ . '/../../backend',
                __DIR__ . '/../../common',
            ],
            'messagePath' => __DIR__  . '/../../messages',
            'translations' => [
                '*' => [
                    'class'           => yii\i18n\DbMessageSource::className(),
                    'enableCaching'   => true,
                    'cachingDuration' => 60 * 60 * 2, // cache on 2 hourse
                ],
            ],
        ],
    ],
];
