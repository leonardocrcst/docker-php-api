<?php

use Dotenv\Dotenv;

Dotenv::createImmutable(__DIR__)
    ->load();

define('DB_NAME', str_replace(['.db', '../'], '', $_ENV['DB_NAME']));

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
            'adapter' => 'sqlite',
            'name' => './tests/' . DB_NAME . '-development',
            'suffix' => '.db',
            'charset' => 'utf8mb4',
        ],
        'testing' => [
            'adapter' => 'sqlite',
            'name' => './tests/' . DB_NAME . '-testing',
            'suffix' => '.db',
            'charset' => 'uft8mb4'
        ]
    ],
    'version_order' => 'creation'
];
