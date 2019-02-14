<?php

return [
    'fetch'     => PDO::FETCH_OBJ,
    'driver'    => 'mysql',
    'mysql'     => [
        'host'      => '127.0.0.1',
        'user'      => 'root',
        'pass'      => '',
        'db'        => 'algebra_contacts',
        'charset'   => 'utf8',
        'collation' => 'utf8_general_ci'
    ],
    'sqlite'    => [
        'db'        => ''
    ],
    'pgsql'     => [
        'host'      => '',
        'user'      => '',
        'pass'      => '',
        'db'        => '',
        'charset'   => 'utf8',
        'collation' => 'utf8_general_ci'
    ]
]

?>