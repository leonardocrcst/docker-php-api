<?php

namespace App\Application\UseCase\Session;

class UsuarioConectado
{
    static public function verificar(): bool
    {
        if (!empty($_SESSION['user'])) {
            return true;
        }
        return false;
    }
}