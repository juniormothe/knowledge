<?php

namespace App\Controllers;

use Core\Controller;

/**
 * @copyright (c) 2023, Junior Silva
 */
class Photos extends Controller
{
    public function index()
    {
    }

    public function new()
    {
        $array = array();
        $array['error'] = NULL;
        $array['validation'] = FALSE;
        $method = $this->getMethod();
        $data = $this->getRequestData();
        if ($method <> "POST") {
            $array['error'] = 'incorrect method';
        } else {
            if (!empty($data['token'])) {
                if ((isset($_FILES['photo'])) && ($_FILES['photo']['size'] > 0)) {
                    $Photos = new \App\Models\Photos\Photos();
                    if ($Photos->new($data['token'], $_FILES['photo'])) {
                        $array['validation'] = TRUE;
                    } else {
                        $array['error'] = 'invalid token';
                    }
                } else {
                    $array['error'] = 'photo not sent';
                }
            } else {
                $array['error'] = 'token not sent';
            }
        }
        $this->retunJson($array);
    }


}
