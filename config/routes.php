<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

return function (App $app) {
    $app->any(
        '/api[/{args:.*}]',
        function (
            ServerRequestInterface $request,
            ResponseInterface $response,
            array $args = []
        ) {
            $response->getBody()->write(json_encode(['message' => 'Olá, mundo!', 'data' => $args]));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }
    );

    $app->any('/', fn () => header('Location: http://localhost:5173'));
};
