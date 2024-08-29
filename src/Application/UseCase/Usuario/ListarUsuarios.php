<?php

namespace App\Application\UseCase\Usuario;

use App\Application\Builder\Usuario\UsuarioBuilder;
use App\Application\ResponseBody;
use App\Application\UseCase\UseCase;
use Psr\Http\Message\ResponseInterface;

class ListarUsuarios extends UseCase
{

    public function execute(): ResponseInterface
    {
        $data = $this->getUsersLists();
        $response = new ResponseBody(
            'OK',
            !empty($data) ? 200 : 204,
            $data
        );
        return $this->createResponse($response);
    }

    private function getUsersLists(): ?array
    {
        $this->repository->setTable('users');
        return array_map(function ($data) {
            return UsuarioBuilder::fromArray($data);
        }, $this->repository->list());
    }
}