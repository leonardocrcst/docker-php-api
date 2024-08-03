<?php

use Dotenv\Dotenv;

$env = Dotenv::createImmutable(__DIR__);
$env->load();

return
[
    'paths' => [
        'migrations' => 'src/Infrastructure/Database/Migrations',
        'seeds' => 'src/Infrastructure/Database/Seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'testing',
        'production' => [
            'adapter' => $_ENV['DB_TYPE'],
            'host' => $_ENV['DB_HOST'],
            'name' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'pass' => $_ENV['DB_PASS'],
            'port' => $_ENV['DB_PORT'],
            'charset' => 'utf8mb4',
        ],
        'development' => [
            'adapter' => $_ENV['DB_TYPE'],
            'name' => str_replace(['.db', '../'], '', $_ENV['DB_NAME']),
            'suffix' => '.db',
            'charset' => 'utf8mb4',
        ],
        'testing' => [
            'adapter' => 'sqlite',
            'name' => './Tests/kitnet-test',
            'suffix' => '.db',
            'charset' => 'uft8mb4'
        ]
    ],
    'version_order' => 'creation'
];
