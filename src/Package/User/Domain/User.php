<?php

namespace App\Package\User\Domain;

use App\Package\Common\Domain\Entity;
use App\Package\Common\DTO\DataTransferObject;
use App\Package\User\DTO\UserDto;
use App\Package\User\Exception\EmptyPasswordException;
use App\Package\User\Exception\EmptyUsernameException;
use App\Package\User\Exception\InvalidPasswordException;

class User extends Entity
{
    protected ?string $username = null;
    protected ?string $password = null;

    public function inactivate(): void
    {
        $this->delete();
    }

    /**
     * @throws InvalidPasswordException
     */
    public function changePassword(string $old, string $new): void
    {
        if (!password_verify($old, $this->password)) {
            throw new InvalidPasswordException();
        }
        $this->password = password_hash($new, PASSWORD_DEFAULT);
        $this->update();
    }

    public function checkPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    public function map(UserDto|DataTransferObject $data): void
    {
        $this->id = $data->id;
        $this->createdAt = $data->createdAt;
        $this->deletedAt = $data->deletedAt;
        $this->username = $data->username;
        $this->password = empty($data->id)
            ? password_hash($data->password, PASSWORD_DEFAULT)
            : $data->password;
    }

    /**
     * @throws EmptyPasswordException
     * @throws EmptyUsernameException
     */
    public function validate(): void
    {
        if (empty($this->username)) {
            throw new EmptyUsernameException();
        }
        if (empty($this->password)) {
            throw new EmptyPasswordException();
        }
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'created_at' => $this->createdAt?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt?->format('Y-m-d H:i:s'),
            'deleted_at' => $this->deletedAt?->format('Y-m-d H:i:s'),
            'username' => $this->username,
            'password' => $this->password,
        ];
    }
}
