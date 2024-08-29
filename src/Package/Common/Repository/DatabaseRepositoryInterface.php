<?php

namespace App\Package\Common\Repository;

interface DatabaseRepositoryInterface
{
    public function create(array $data): int;

    public function update(array $data, ?string $identificationField = 'id'): void;

    public function delete(array $data, ?string $identificationField = 'id'): void;

    public function list(array $columns = ['*']): ?array;

    public function open(int $id, array $columns = ['*']): ?array;
}