<?php

namespace App\Infrastructure\Database\Repository\Trait;

trait CreateTrait
{
    public function create(array $data): int
    {
        $insert = $this->queryFactory->newInsert();
        $insert
            ->into($this->table)
            ->cols(array_filter($data));

        $request = $this->pdo->prepare($insert->getStatement());
        $request->execute($insert->getBindValues());
        $id = $insert->getLastInsertIdName('id');
        return $this->pdo->lastInsertId($id);
    }
}
