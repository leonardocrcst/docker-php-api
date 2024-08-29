<?php

namespace App\Application\UseCase;

use App\Application\ResponseBody;
use App\Package\Common\Repository\DatabaseRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

abstract class UseCase
{
    protected ServerRequestInterface $request;
    protected ResponseInterface $response;
    protected array $args;

    public function __construct(
        protected DatabaseRepositoryInterface $repository
    ) {
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $this->start($request, $response, $args);
        try {
            return $this->execute();
        } catch (Throwable $exception) {
            return $this->getExecutionError($exception);
        }
    }

    protected function start(ServerRequestInterface $request, ResponseInterface $response, array $args): void
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
    }

    private function getExecutionError(Throwable $exception): ResponseInterface
    {
        $content = [
            'error' => [
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ],
            'code' => $exception->getCode() >= 100 && $exception->getCode() <= 599 ? $exception->getCode() : 500,
        ];
        $error = new ResponseBody(
            'Error',
            $exception->getCode() >= 100 && $exception->getCode() <= 599 ? $exception->getCode() : 500,
            $content
        );
        return $this->createResponse($error);
    }

    protected function createResponse(ResponseBody $body): ResponseInterface
    {
        $this->response->getBody()->write(json_encode($body));
        return $this->response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($body->code);
    }

    abstract public function execute(): ResponseInterface;
}