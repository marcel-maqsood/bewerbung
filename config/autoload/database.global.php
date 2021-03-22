<?php

return [
    'db' => [
        'adapters' => [
            'Application\Db\DatabaseAdapter' => [
                'driver'    => 'Pdo_Mysql',
                'hostname'  =>  'localhost',
                'charset'   =>  'Utf8',
                'database'  =>  'ChatApp',
                'username'  =>  '', //Aus sicherheit mache ich das nicht öffentlich :^)
                'password'  =>  '' //Aus sicherheit mache ich das nicht öffentlich :^)
            ],
        ],
    ],
];