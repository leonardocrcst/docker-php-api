<?php

namespace App\Infrastructure\Database\Repository\Trait;

trait DeleteTrait
{
    public function delete(array $data, ?string $identificationField = 'id'): void
    {
        $update = $this->queryFactory->newUpdate();
        $update
            ->table($this->table)
            ->cols(array_filter($data))
            ->where("$identificationField = :id", ["id" => $data[$identificationField]]);

        $request = $this->pdo->prepare($update->getStatement());
        $request->execute($update->getBindValues());
    }
}