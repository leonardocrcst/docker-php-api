<?php

namespace App\Application\UseCase\User;

use App\Application\Builder\Usuario\UsuarioBuilder;
use App\Application\ResponseBody;
use App\Application\UseCase\UseCase;
use App\Infrastructure\Database\DatabaseTables;
use App\Package\User\Domain\User;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class CriarUsuario extends UseCase
{
    /**
     * @throws Throwable
     */
    public function execute(): ResponseInterface
    {
        $this->repository->setTable(DatabaseTables::USERS->value);
        $user = new User();
        $user->map(UsuarioBuilder::fromRequest($this->request));
        $user->validate();
        $response = new ResponseBody(
            'Created',
            201,
            [
                'id' => $this->repository->create($user->toArray())
            ]
        );
        return $this->createResponse($response);
    }
}