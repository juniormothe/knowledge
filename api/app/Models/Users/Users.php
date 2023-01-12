<?php

namespace App\Models\Users;

use App\Models\jwt\jwt;

/**
 * @copyright (c) 2023, Junior Silva
 */
class Users
{
    public static $crud;
    private $idUser;

    public function __construct()
    {
        self::$crud = new \App\Models\Helpers\CrudComplete();
    }

    public function checkCredentials($email, $pass)
    {
        if (self::$crud->read("users", "WHERE (email='" . addslashes($email) . "')")) {
            if (self::$crud->read("users", "WHERE (email='" . addslashes($email) . "') AND (pass='" . md5($pass) . "')")) {
                $dataUser = self::$crud->read("users", "WHERE (email='" . addslashes($email) . "') AND (pass='" . md5($pass) . "')");
                $this->idUser = $dataUser[0]['id'];
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function createUser($name, $email, $pass)
    {
        $Create = new \App\Models\Helpers\Create();
        $Create->exeCreate("users", ['name' => $name, 'email' => $email, 'pass' => md5($pass)]);
        if ($Create->getResultado()) {
            $this->idUser = $Create->getResultado();
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getInfo($token)
    {
        $data = $this->validateJwt($token);
        if (isset($data['id'])) {
            unset($data['pass']);
            if (!empty($data['avatar'])) {
                $data['avatar'] = AVATAR . "/" . $data['id'] . "/" . $data['avatar'];
            } else {
                $data['avatar'] = AVATAR . "/0/default.png";
            }
            $data['following'] = self::$crud->count("users_following", "id", "WHERE (id_user_active='" . $data['id'] . "')");
            $data['followers'] = self::$crud->count("users_following", "id", "WHERE (id_user_passive='" . $data['id'] . "')");
            $data['photos'] = self::$crud->count("photos", "id", "WHERE (id_user='" . $data['id'] . "')");
            return $data;
        } else {
            return FALSE;
        }
    }

    public function updateInfo($token, $name, $email, $pass)
    {
        $data = $this->validateJwt($token);
        if (isset($data['id'])) {
            if ((empty($name)) && (empty($email)) && (empty($pass))) {
                return 'update data not sent';
            } else {

                if (!empty($email)) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $read = new \App\Models\Helpers\Read();
                        $read->exeRead("users", "WHERE (email='" . $email . "') AND (id<>'" . $data['id'] . "')");
                        if ($read->getResultado()) {
                            return 'email is in use';
                        } else {
                            $dataUpdate = array();
                            if (!empty($name)) {
                                $dataUpdate['name'] = $name;
                            }
                            if (!empty($pass)) {
                                $dataUpdate['pass'] = md5($pass);
                            }
                            $dataUpdate['email'] = $email;
                            self::$crud->update("users", $dataUpdate, "WHERE (id='" . $data['id'] . "')");
                            return TRUE;
                        }
                    } else {
                        return 'invalid email';
                    }
                } else {
                    $dataUpdate = array();
                    if (!empty($name)) {
                        $dataUpdate['name'] = $name;
                    }
                    if (!empty($pass)) {
                        $dataUpdate['pass'] = md5($pass);
                    }
                    self::$crud->update("users", $dataUpdate, "WHERE (id='" . $data['id'] . "')");
                    return TRUE;
                }
            }
        } else {
            return FALSE;
        }
    }

    public function deleteUser($token)
    {
        $data = $this->validateJwt($token);
        if (isset($data['id'])) {
            self::$crud->delete("photos", "WHERE (id_user='" . $data['id'] . "')");
            self::$crud->delete("photos_comments", "WHERE (id_user='" . $data['id'] . "')");
            self::$crud->delete("photos_likes", "WHERE (id_user='" . $data['id'] . "')");
            self::$crud->delete("users_following", "WHERE (id_user_active='" . $data['id'] . "')");
            self::$crud->delete("users_following", "WHERE (id_user_passive='" . $data['id'] . "')");
            self::$crud->delete("users", "WHERE (id='" . $data['id'] . "')");
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function createJwt()
    {
        $jwt = new jwt();
        return $jwt->create(['id_user' => $this->idUser]);
    }

    private function validateJwt($token)
    {
        $jwt = new jwt();
        if ($jwt->validate($token)) {
            $data = $jwt->validate($token);
            if (isset($data['id_user'])) {
                if (self::$crud->read("users", "WHERE (id='" . $data['id_user'] . "') ")) {
                    $data = self::$crud->read("users", "WHERE (id='" . $data['id_user'] . "') ");
                    return $data[0];
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
}
