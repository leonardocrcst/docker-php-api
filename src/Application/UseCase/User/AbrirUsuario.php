<?php

namespace App\Application\UseCase\User;

use App\Application\Builder\Usuario\UsuarioBuilder;
use App\Application\ResponseBody;
use App\Application\UseCase\UseCase;
use App\Infrastructure\Database\DatabaseTables;
use App\Infrastructure\Database\Repository\Trait\OpenTrait;
use App\Package\Common\Repository\DatabaseRepositoryInterface;
use App\Package\User\DTO\UserDto;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;

class AbrirUsuario extends UseCase
{
    public function execute(): ResponseInterface
    {
        $user = $this->openUserById($this->getUserId());
        $response = new ResponseBody(
            'OK',
            !empty($user->id) ? 200 : 204,
            $user
        );
        return $this->createResponse($response);
    }

    private function getUserId(): int
    {
        if (empty($this->args['id'])) {
            throw new InvalidArgumentException('User id is required', 400);
        }
        return $this->args['id'];
    }

    private function openUserById(int $id): ?UserDto
    {
        $this->repository->setTable(DatabaseTables::USERS->value);
        $data = $this->repository->open($id);
        return !empty($data)
            ? UsuarioBuilder::fromArray($data)
            : null;
    }
}