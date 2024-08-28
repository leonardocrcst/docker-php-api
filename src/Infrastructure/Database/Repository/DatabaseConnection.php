<?php

namespace App\Infrastructure\Database\Repository;

use PDO;

class DatabaseConnection
{
    static public function connect(): ?PDO
    {
        switch ($_ENV['DB_TYPE']) {
            case 'mysql':
                return new PDO(
                    "mysql:dbname={$_ENV['DB_NAME']};host={$_ENV['DB_HOST']}",
                    $_ENV['DB_USER'],
                    $_ENV['DB_PASS']
                );
            case 'sqlite':
                $name = __DIR__ . "/../../../../{$_ENV['DB_NAME']}";
                return new PDO(
                    "sqlite:$name",
                );
            default:
                return null;
        }
    }
}