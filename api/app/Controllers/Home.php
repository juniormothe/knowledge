<?php

namespace App\Controllers;

use Core\Controller;

/**
 * @copyright (c) 2023, Junior Silva
 */
class Home extends Controller
{
    private $dados;

    public function index()
    {
        $array = ['name' => 'junior', 'idade' => '37'];
        $this->retunJson($array);
    }
}
