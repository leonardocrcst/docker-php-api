<?php

namespace App\Package\User\Exception;

class EmptyPasswordException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Empty password.', 400);
    }
}