<?php

namespace App\Package\Common\Domain;

use App\Package\Common\DTO\DataTransferObject;
use DateTime;

abstract class Entity
{
    protected ?DateTime $updatedAt = null;
    protected ?DateTime $deletedAt = null;

    public function __construct(
        protected ?int $id = null,
        protected ?DateTime $createdAt = null
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreateTimestamp(): ?DateTime
    {
        return $this->createdAt;
    }

    public function update(): void
    {
        $this->updatedAt = new DateTime();
    }

    public function getUpdateTimestamp(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function getDeleteTimestamp(): ?DateTime
    {
        return $this->deletedAt;
    }

    public function delete(): void
    {
        $this->deletedAt = new DateTime();
        $this->update();
    }

    public function isActive(): bool
    {
        return $this->createdAt instanceof DateTime && empty($this->deletedAt);
    }

    abstract public function toArray(): array;

    abstract public function map(DataTransferObject $data): void;

    abstract public function validate(): void;
}
