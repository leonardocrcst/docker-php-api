<?php

namespace App\Package\Common\Domain;

use App\Package\Common\DTO\DataTransferObject;
use DateTime;

interface EntityInterface
{
    public function getId(): ?int;

    public function getCreateTimestamp(): ?DateTime;

    public function update(): void;

    public function getUpdateTimestamp(): ?DateTime;

    public function getDeleteTimestamp(): ?DateTime;

    public function delete(): void;

    public function isActive(): bool;

    public function toArray(): array;

    public function map(DataTransferObject $data): void;

    public function validate(): void;
}
