<?php

namespace App\Application\Builder\Usuario;

use App\Application\Builder\BuilderInterface;
use App\Application\Builder\JsonBuilder;
use App\Package\User\DTO\UserDto;
use DateTime;
use Exception;
use JsonException;
use Psr\Http\Message\ServerRequestInterface;

class UsuarioBuilder implements BuilderInterface
{
    use JsonBuilder;

    /**
     * @throws JsonException
     */
    static public function fromRequest(ServerRequestInterface $request): UserDto
    {
        $userJson = self::fromString($request->getBody()->getContents());
        return new UserDto(
            null,
            new DateTime(),
            null,
            null,
            $userJson->username,
            $userJson->password,
        );
    }

    /**
     * @throws Exception
     */
    static public function fromArray(array $data): UserDto
    {
        return new UserDto(
            $data['id'] ?? null,
            $data['created_at'] ? new DateTime($data['created_at']) : null,
            $data['updated_at'] ? new DateTime($data['updated_at']) : null,
            $data['deleted_at'] ? new DateTime($data['deleted_at']) : null,
            $data['username'] ?? null,
            $data['password'] ?? null,
        );
    }
}