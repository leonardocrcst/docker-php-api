<?php

use App\Application\UseCase\Session\UsuarioConectado;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\App;

return function (ServerRequestInterface $request, RequestHandlerInterface $handler, App &$app) {
    if (!UsuarioConectado::verificar()) {
        $response = $app->getResponseFactory()->createResponse();
        $response->getBody()->write('{"message": "Unauthorized"}');
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(401);
    }

    return $handler->handle($request);
};
