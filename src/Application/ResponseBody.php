<?php

namespace App\Application;

use App\Package\Common\DTO\DataTransferObject;

readonly class ResponseBody
{
    public function __construct(
        public ?string $message = null,
        public ?int $code = null,
        public array|DataTransferObject|null $data = null,
    ) {
    }
}