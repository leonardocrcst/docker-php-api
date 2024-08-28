<?php

namespace App\Application;

readonly class ResponseBody
{
    public function __construct(
        public ?string $message = null,
        public ?int $code = null,
        public ?array $data = null,
    ) {
    }
}