<?php

namespace App\Package\User\Exception;

class InvalidPasswordException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Invalid password.', 401);
    }
}