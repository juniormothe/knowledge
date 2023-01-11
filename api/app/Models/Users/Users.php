<?php

namespace App\Models\Users;

if (!defined('URL')) {
    header("Location: ../../../Erro");
    exit();
}
/**
 * @copyright (c) 2023, Junior Silva
 */
class Users
{
    public  static $crud;

    public function __construct()
    {
        self::$crud = new \App\Models\Helpers\CrudComplete();
    }

    public function checkCredentials($email, $pass)
    {
    }
}
