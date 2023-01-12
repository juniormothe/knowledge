<?php

namespace App\Models\Photos;

use App\Models\jwt\jwt;

/**
 * @copyright (c) 2023, Junior Silva
 */
class Photos
{
    private $Create;
    private $Read;
    private $Update;
    private $Delete;
    private $UploadImg;

    public function __construct()
    {
        $this->Create = new \App\Models\Helpers\Create();
        $this->Read = new \App\Models\Helpers\Read();
        $this->Update = new \App\Models\Helpers\Update();
        $this->Delete = new \App\Models\Helpers\Delete();
        $this->UploadImg = new \App\Models\Helpers\UploadImg();
    }

    public function new($token, $photo)
    {
        $data = $this->validateJwt($token);
        if (isset($data['id'])) {
            $extension = explode('/', $photo['type']);
            $name = md5(time() . rand(0, 99)) . "." . $extension[1];
            $this->UploadImg->uploadImagem($photo, "media/photos/" . $data['id'] . "/", $name);
            if (file_exists("media/photos/" . $data['id'] . "/" . $name)) {
                $dataCreate = array();
                $dataCreate['id_user'] = $data['id'];
                $dataCreate['url'] = $name;
                $this->Create->exeCreate("photos", $dataCreate);
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

    

    private function validateJwt($token)
    {
        $jwt = new jwt();
        if ($jwt->validate($token)) {
            $data = $jwt->validate($token);
            if (isset($data['id_user'])) {
                $this->Read->exeRead("users", "WHERE (id='" . $data['id_user'] . "')");
                if ($this->Read->getResultado()) {
                    $data = $this->Read->getResultado();
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
