<?php

namespace App\Application\UseCase\Session;

use App\Application\ResponseBody;
use App\Application\UseCase\UseCase;
use Exception;
use Psr\Http\Message\ResponseInterface;

class LogoutUsuario extends UseCase
{
    /**
     * @throws Exception
     */
    public function execute(): ResponseInterface
    {
        if (!empty($_SESSION['user'])) {
            session_unset();
            session_destroy();
        }
        return $this->createResponse(new ResponseBody('Bye.', 200));
    }
}