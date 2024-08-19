<?php

namespace App\Package\User\Exception;

class EmptyUsernameException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Username cannot be empty.', 400);
    }
}