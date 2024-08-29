<?php

namespace App\Infrastructure\Database\Repository\Trait;

use PDO;

trait OpenTrait
{
    public function open(int $id, array $columns = ['*']): ?array
    {
        $select = $this->queryFactory->newSelect();
        $select
            ->from($this->table)
            ->cols($columns)
            ->where('id = :id');
        $select->bindValue('id', $id);

        $request = $this->pdo->prepare($select->getStatement());
        $request->execute($select->getBindValues());
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if (!empty($data)) {
            return $data;
        }
        return null;
    }

    public function openBy(string $column, mixed $value, array $columns = ['*']): ?array
    {
        $select = $this->queryFactory->newSelect();
        $select
            ->from($this->table)
            ->cols($columns)
            ->where("$column = :value");
        $select->bindValue('value', $value);

        $request = $this->pdo->prepare($select->getStatement());
        $request->execute($select->getBindValues());
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if (!empty($data)) {
            return $data;
        }
        return null;
    }

    public function openOnlyActive(int $id, array $columns = ['*']): ?array
    {
        $select = $this->queryFactory->newSelect();
        $select
            ->from($this->table)
            ->cols($columns)
            ->where('id = :id')
            ->where('deleted_at IS NULL');
        $select->bindValue('id', $id);

        $request = $this->pdo->prepare($select->getStatement());
        $request->execute($select->getBindValues());
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return $data;
        }
        return null;
    }
}