<?php

namespace App\Application\UseCase\Usuario;

use App\Application\Builder\Usuario\UsuarioBuilder;
use App\Application\ResponseBody;
use App\Application\UseCase\UseCase;
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
        $this->repository->setTable('users');
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