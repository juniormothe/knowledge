<?php

namespace App\Controllers;

use Core\Controller;

/**
 * @copyright (c) 2023, Junior Silva
 */
class Users extends Controller
{
    public function index()
    {
        
    }

    public function login()
    {
        $array = ['error' => NULL];
        $method = $this->getMethod();
        $data = $this->getRequestData();
        if ($method <> "POST") {
            $array = ['error' => 'incorrect method'];
        } else {
            if ((!empty($data['email'])) && (!empty($data['pass']))) {

                $Users = new \App\Models\Users\Users();

            } else {
                $array = ['error' => 'email or password not sent'];
            }
        }
        $this->retunJson($array);
    }
}
