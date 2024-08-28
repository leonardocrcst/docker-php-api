<?php

namespace App\Infrastructure\Database\Repository;

use App\Infrastructure\Database\Repository\Trait\CreateTrait;
use App\Infrastructure\Database\Repository\Trait\DeleteTrait;
use App\Infrastructure\Database\Repository\Trait\ListTrait;
use App\Infrastructure\Database\Repository\Trait\OpenTrait;
use App\Infrastructure\Database\Repository\Trait\UpdateTrait;
use App\Package\Common\Repository\DatabaseRepositoryInterface;
use Aura\SqlQuery\QueryFactory;
use PDO;

class DatabaseRepository implements DatabaseRepositoryInterface
{
    use ListTrait;
    use OpenTrait;
    use CreateTrait;
    use UpdateTrait;
    use DeleteTrait;

    protected QueryFactory $queryFactory;
    protected string $table;
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = DatabaseConnection::connect();
        $this->queryFactory = new QueryFactory($_ENV['DB_TYPE']);
    }

    public function setTable(string $table): void
    {
        $this->table = $table;
    }
}