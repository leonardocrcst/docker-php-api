<?php

namespace App\Application\Builder;

use App\Package\Common\DTO\DataTransferObject;
use Psr\Http\Message\ServerRequestInterface;

interface BuilderInterface
{
    static public function fromRequest(ServerRequestInterface $request): DataTransferObject;
}