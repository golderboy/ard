<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yiiweb;port=3306',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
              /*  'slaveConfig' => [
                      'username' => 'slave',
                      'password' => 'pass',
                      'charset' => 'utf8',
                  ],
                  'slaves' => [
                          ['dsn' => 'mysql:host=5.5.5.5;dbname=slavedb']
                  ]
                  */
        ],
        'db_hdc' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=192.168.1.6;dbname=dhdc;port=3306',
            'username' => 'sa',
            'password' => 'sa',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => FALSE,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'jobs.golderboy@gmail.com',
                'password' => 'magcartoon',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
    ],
];
