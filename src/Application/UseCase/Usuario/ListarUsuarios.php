<?php

namespace App\Application\UseCase\Usuario;

use App\Application\UseCase\UseCase;
use Psr\Http\Message\ResponseInterface;

class ListarUsuarios extends UseCase
{

    public function execute(): ResponseInterface
    {
        $list = ['listar', 'usuários'];
        $this->response->getBody()->write(json_encode($list));
        return $this->response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}