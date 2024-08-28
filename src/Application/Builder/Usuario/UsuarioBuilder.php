<?php

namespace App\Application\Builder\Usuario;

use App\Application\Builder\BuilderInterface;
use App\Application\Builder\JsonBuilder;
use App\Package\User\DTO\UserDto;
use DateTime;
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
}