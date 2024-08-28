<?php

namespace App\Application\UseCase\Usuario;

use App\Application\ResponseBody;
use App\Application\UseCase\UseCase;
use App\Package\User\Domain\User;
use Psr\Http\Message\ResponseInterface;

class RemoverUsuario extends UseCase
{

    public function execute(): ResponseInterface
    {
        $this->repository->setTable('users');
        $user = new User($this->args['id']);
        $user->inactivate();
        $this->repository->delete($user->toArray());
        $response = new ResponseBody(
            'Inactivated user',
            200
        );
        $this->response->getBody()->write(json_encode($response));
        return $this->response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($response->code);
    }
}