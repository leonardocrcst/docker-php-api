<?php

use App\Application\UseCase\Session\LoginUsuario;
use App\Application\UseCase\Session\LogoutUsuario;
use App\Application\UseCase\Session\RefreshUsuario;
use App\Application\UseCase\User\AbrirUsuario;
use App\Application\UseCase\User\AtualizarUsuario;
use App\Application\UseCase\User\CriarUsuario;
use App\Application\UseCase\User\ListarUsuarios;
use App\Application\UseCase\User\RemoverUsuario;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

/**
 * POST: novo conjunto de dados
 * PUT: substitui completamente um conjunto de dados
 * PATCH: altera parte de um conjunto de dados
 * GET: recupera um conjunto de dados
 */

return function (App $app) {
    $checkUserAuthentication = require_once __DIR__ . '/../middleware/checkUserAuthentication.php';

    $app->group('/api', function (RouteCollectorProxy $group) {
        $group->post('/users[/]', CriarUsuario::class);
        $group->post('/session/login', LoginUsuario::class);
    });

    $app->group('/api', function (RouteCollectorProxy $api) {
        $api->group('/session', function (RouteCollectorProxy $group) {
            $group->get('/refresh', RefreshUsuario::class);
            $group->get('/logout', LogoutUsuario::class);
        });

        $api->group('/users', function (RouteCollectorProxy $group) {
            $group->patch('/{id}', AtualizarUsuario::class);
            $group->delete('/{id}', RemoverUsuario::class);
            $group->get('[/]', ListarUsuarios::class);
            $group->get('/{id}', AbrirUsuario::class);
        });
    })->add(
        function (ServerRequestInterface $request, RequestHandlerInterface $handler) use ($checkUserAuthentication, $app) {
            return $checkUserAuthentication($request, $handler, $app);
        }
    );

    $app->any(
        '/api[/{args:.*}]',
        function (
            ServerRequestInterface $request,
            ResponseInterface $response
        ) {
            $data = json_encode(['message' => 'Not found']);
            $response->getBody()->write($data);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }
    );

    $app->any('[/]', fn() => header('Location: http://localhost:5173'));
};
