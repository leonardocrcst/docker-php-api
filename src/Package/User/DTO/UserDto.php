<?php

namespace App\Package\User\DTO;

use App\Package\Common\DTO\DataTransferObject;
use DateTime;

readonly class UserDto implements DataTransferObject
{
    public function __construct(
        public ?string $id = null,
        public ?DateTime $createdAt = null,
        public ?DateTime $updatedAt = null,
        public ?DateTime $deletedAt = null,
        public ?string $username = null,
        public ?string $password = null
    ) {
    }
}