<?php

namespace App\Application\UseCase\Usuario;

use App\Application\UseCase\UseCase;
use Psr\Http\Message\ResponseInterface;

class AtualizarUsuario extends UseCase
{

    public function execute(): ResponseInterface
    {
        $list = ['atualizar', 'usuário'];
        $this->response->getBody()->write(json_encode($list));
        return $this->response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}