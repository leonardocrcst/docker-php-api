<?php

use App\Application\UseCase\Usuario\AbrirUsuario;
use App\Application\UseCase\Usuario\AtualizarUsuario;
use App\Application\UseCase\Usuario\CriarUsuario;
use App\Application\UseCase\Usuario\ListarUsuarios;
use App\Application\UseCase\Usuario\RemoverUsuario;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

/**
 * POST: novo conjunto de dados
 * PUT: substitui completamente um conjunto de dados
 * PATCH: altera parte de um conjunto de dados
 * GET: recupera um conjunto de dados
 */

return function (App $app) {
    $app->group('/api/users', function (RouteCollectorProxy $group) {
        $group->post('[/]', CriarUsuario::class);
        $group->patch('/{id}', AtualizarUsuario::class);
        $group->delete('/{id}', RemoverUsuario::class);
        $group->get('[/]', ListarUsuarios::class);
        $group->get('/{id}', AbrirUsuario::class);
    });

    $app->any(
        '/api[/{args:.*}]',
        function (
            ServerRequestInterface $request,
            ResponseInterface $response,
            array $args = []
        ) {
            return tempResponse($response, $args);
        }
    );

    $app->any('[/]', fn() => header('Location: http://localhost:5173'));
};

function tempResponse(ResponseInterface $response, array $args): ResponseInterface
{
    $data = json_encode(['message' => 'Test OK', 'data' => $args]);
    $response->getBody()->write($data);
    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
}
