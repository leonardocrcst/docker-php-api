<?php

namespace App\Infrastructure\Database\Repository\Trait;

use InvalidArgumentException;

trait UpdateTrait
{
    public function update(array $data, ?string $identificationField = 'id'): void
    {
        if (empty($data[$identificationField])) {
            throw new InvalidArgumentException('Identification field is required.', 400);
        }
        $update = $this->queryFactory->newUpdate();
        $update
            ->table($this->table)
            ->cols(array_filter($data))
            ->where("$identificationField = :id", ["id" => $data[$identificationField]]);

        $request = $this->pdo->prepare($update->getStatement());
        $request->execute($update->getBindValues());
    }
}