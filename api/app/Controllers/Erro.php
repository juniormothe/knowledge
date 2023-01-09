<?php

namespace App\Controllers;

use Core\Controller;

/**
 * @copyright (c) 2023, Junior Silva
 */
class Erro extends Controller
{
    private $dados;

    public function index()
    {
        $this->retunJson(array());
    }
}
