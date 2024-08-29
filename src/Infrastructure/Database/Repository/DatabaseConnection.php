<?php

namespace App\Infrastructure\Database\Repository;

use Exception;
use PDO;

class DatabaseConnection
{
    static public ?PDO $connection = null;

    /**
     * @throws Exception
     */
    static public function connect(): ?PDO
    {
        if (empty(self::$connection)) {
            switch ($_ENV['DB_TYPE']) {
                case 'mysql':
                    self::$connection = new PDO(
                        "mysql:dbname={$_ENV['DB_NAME']};host={$_ENV['DB_HOST']}",
                        $_ENV['DB_USER'],
                        $_ENV['DB_PASS']
                    );
                    break;
                case 'sqlite':
                    $name = __DIR__ . "/../../../../{$_ENV['DB_NAME']}";
                    self::$connection = new PDO(
                        "sqlite:$name",
                    );
                    break;
                default:
                    throw new Exception("Database type '{$_ENV['DB_TYPE']}' is not supported.", 500);
            }
        }
        return self::$connection;
    }
}