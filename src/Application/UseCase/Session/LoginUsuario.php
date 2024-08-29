<?php

namespace App\Application\UseCase\Session;

use App\Application\Builder\Usuario\UsuarioBuilder;
use App\Application\ResponseBody;
use App\Application\UseCase\UseCase;
use App\Infrastructure\Database\DatabaseTables;
use App\Package\User\Domain\User;
use Exception;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;

class LoginUsuario extends UseCase
{
    /**
     * @throws Exception
     */
    public function execute(): ResponseInterface
    {
        $this->repository->setTable(DatabaseTables::USERS->value);
        $user = $this->getUser();
        $_SESSION['user'] = $user->toArray();
        unset($_SESSION['user']['password']);
        $response = new ResponseBody(
            'OK',
            200,
            $_SESSION['user']
        );
        return $this->createResponse($response);
    }

    /**
     * @throws Exception
     */
    private function getUser(): User
    {
        $requestBody = json_decode($this->request->getBody()->getContents(), true);
        if (empty($requestBody['username'])) {
            throw new InvalidArgumentException('Username and password are required.', 400);
        }
        $data = $this->repository->openBy('username', $requestBody['username']);
        if (!empty($data)) {
            $user = new User();
            $user->map(UsuarioBuilder::fromArray($data));
            if ($user->checkPassword($requestBody['password'])) {
                return $user;
            }
            throw new InvalidArgumentException('Invalid password.', 401);
        }
        throw new InvalidArgumentException('User not found.', 404);
    }
}