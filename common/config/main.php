<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'uploadFile' => [
            'class' => 'common\components\UploadFile',
        ],
        'mails' => [
            'class' => 'common\components\SendMail',
        ],
    ],
];
