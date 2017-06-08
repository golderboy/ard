<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=db_ard;port=3306',
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

        'mailer' => [
           /*
			   'class' => 'yii\swiftmailer\Mailer',
				'useFileTransport' => TRUE,
				'transport' => [
					'class' => 'Swift_SmtpTransport',
					'host' => 'smtp.gmail.com',
					'username' => 'admin@gmail.com',
					'password' => '',
					'port' => '465',
					'encryption' => 'ssl',
				],
			*/
        ],
    ],
];
