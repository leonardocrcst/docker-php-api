<?php

namespace App\Application\Builder;

use JsonException;
use stdClass;

trait JsonBuilder
{
    /**
     * @throws JsonException
     */
    static public function fromString(string $json): stdClass
    {
        $parsed = json_decode($json);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new JsonException(json_last_error_msg(), 400);
        }
        return $parsed;
    }
}