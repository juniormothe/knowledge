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
        $array = array();
        $array['error'] = NULL;
        $array['jwt'] = NULL;
        $method = $this->getMethod();
        $data = $this->getRequestData();
        if ($method <> "POST") {
            $array['error'] = 'incorrect method';
        } else {
            if ((!empty($data['email'])) && (!empty($data['pass']))) {
                $Users = new \App\Models\Users\Users();
                if ($Users->checkCredentials($data['email'], $data['pass'])) {
                    $array['jwt'] = $Users->createJwt();
                } else {
                    $array['error'] = 'access denied';
                }
            } else {
                $array['error'] = 'email or password not sent';
            }
        }
        $this->retunJson($array);
    }

    public function new()
    {
        $array = array();
        $array['error'] = NULL;
        $method = $this->getMethod();
        $data = $this->getRequestData();
        if ($method <> "POST") {
            $array['error'] = 'incorrect method';
        } else {
            if ((!empty($data['name'])) && (!empty($data['email'])) && (!empty($data['pass']))) {
                if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $read = new \App\Models\Helpers\Read();
                    $read->exeRead("users", "WHERE (email='" . $data['email'] . "')");
                    if ($read->getResultado()) {
                        $array['error'] = 'email is in use';
                    } else {
                        $Users = new \App\Models\Users\Users();
                        $Users->createUser($data['name'], $data['email'], $data['pass']);
                        $array['jwt'] = $Users->createJwt();
                    }
                } else {
                    $array['error'] = 'invalid email';
                }
            } else {
                $array['error'] = 'name or email or password not sent';
            }
        }
        $this->retunJson($array);
    }

    public function view()
    {
        $array = array();
        $array['error'] = NULL;
        $array['logged'] = FALSE;
        $method = $this->getMethod();
        $data = $this->getRequestData();
        if ($method <> "GET") {
            $array['error'] = 'incorrect method';
        } else {
            if (!empty($data['token'])) {
                $Users = new \App\Models\Users\Users();
                if ($Users->getInfo($data['token'])) {
                    $array['logged'] = TRUE;
                    $array['data'] = $Users->getInfo($data['token']);
                } else {
                    $array['error'] = 'invalid token';
                }
            } else {
                $array['error'] = 'token not sent';
            }
        }
        $this->retunJson($array);
    }

    public function update()
    {
        $array = array();
        $array['error'] = NULL;
        $array['logged'] = FALSE;
        $method = $this->getMethod();
        $data = $this->getRequestData();
        if ($method <> "PUT") {
            $array['error'] = 'incorrect method';
        } else {
            if (!empty($data['token'])) {
                $Users = new \App\Models\Users\Users();
                if (!isset($data['name'])) {
                    $data['name'] = NULL;
                }
                if (!isset($data['email'])) {
                    $data['email'] = NULL;
                }
                if (!isset($data['pass'])) {
                    $data['pass'] = NULL;
                }
                if ($Users->updateInfo($data['token'], $data['name'], $data['email'], $data['pass'])) {
                    $array['error'] = $Users->updateInfo($data['token'], $data['name'], $data['email'], $data['pass']);
                    $array['logged'] = TRUE;
                } else {
                    $array['error'] = 'invalid token';
                }
            } else {
                $array['error'] = 'token not sent';
            }
        }
        $this->retunJson($array);
    }

    public function delete()
    {
        $array = array();
        $array['error'] = NULL;
        $array['logged'] = FALSE;
        $method = $this->getMethod();
        $data = $this->getRequestData();
        if ($method <> "DELETE") {
            $array['error'] = 'incorrect method';
        } else {
            if (!empty($data['token'])) {
                $Users = new \App\Models\Users\Users();
                if ($Users->deleteUser($data['token'])) {
                    $array['logged'] = TRUE;
                } else {
                    $array['error'] = 'invalid token';
                }
            } else {
                $array['error'] = 'token not sent';
            }
        }
        $this->retunJson($array);
    }
}
