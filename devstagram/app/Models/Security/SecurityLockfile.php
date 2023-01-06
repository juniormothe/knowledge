<?php

namespace App\Models\Security;

/**
 * @copyright (c) 2022, Junior Silva
 */
class SecurityLockfile
{
    function __construct()
    {
        $this->lockedFile();
    }

    private function lockedFile()
    {
        if (!defined('URL')) {
            header("Location: ../../../Erro");
            exit();
        }
    }
}
