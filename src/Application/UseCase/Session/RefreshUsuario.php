<?php

namespace App\Application\UseCase\Session;

use App\Application\ResponseBody;
use App\Application\UseCase\UseCase;
use Psr\Http\Message\ResponseInterface;

class RefreshUsuario extends UseCase
{

    public function execute(): ResponseInterface
    {
        $response = new ResponseBody('Service unavailable...', 503);
        return $this->createResponse($response);
    }
}