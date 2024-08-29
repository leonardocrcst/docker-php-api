<?php

namespace App\Infrastructure\Database\Repository\Trait;

use PDO;

trait ListTrait
{
    public function list(array $columns = ['*']): ?array
    {
        $select = $this->queryFactory->newSelect();
        $select
            ->from($this->table)
            ->cols($columns);

        $request = $this->pdo->prepare($select->getStatement());
        $request->execute($select->getBindValues());
        $data = $request->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($data)) {
            return $data;
        }
        return null;
    }
}