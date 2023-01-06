<?php

namespace App\Models\Helpers;

/**
 * @copyright (c) 2022, Junior Silva
 */
class Log
{
    private $ip;
    private $id;
    private $date;
    private $data;

    public function __construct()
    {
        $this->checkData();
    }

    public function save(string $description)
    {
        $this->checkSave($description);
        $Create = new \App\Models\Helpers\Create();
        $Create->exeCreate('log', $this->data);
    }

    private function checkIp()
    {
        $this->ip = 'unknown';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $this->ip = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $this->ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $this->ip = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $this->ip = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $this->ip = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $this->ip = $_SERVER['REMOTE_ADDR'];
        if ($this->ip == "::1") {
            $this->ip = 'local';
        }
    }

    private function checkId()
    {
        if (isset($_SESSION['logged']['id'])) {
            $this->id = $_SESSION['logged']['id'];
        } else {
            $this->id = 0;
        }
    }

    private function checkDate()
    {
        $this->date = date('Y-m-d H:i:s');
    }

    private function checkData()
    {
        $this->checkIp();
        $this->checkId();
        $this->checkDate();
        $this->data = ['ip_log' => $this->ip, 'id_user' => $this->id, 'date_log' => $this->date];
    }

    private function checkSave(string $description)
    {
        $this->data['description'] = trim($description) . " " . $this->checkLink();
    }

    private function checkLink()
    {
        $checkLink = explode(URL, URL_ATUAL);
        $checkLink = $checkLink[1];
        if (empty($checkLink)) {
            $checkLink = 'home';
        } else {
            $checkLink = explode('?', $checkLink);
            $checkLink = $checkLink[0];
        }
        if(($checkLink == "login/logIn") OR ($checkLink == "login/logOut")){
            return '<small style="float: right;">(<a href="' . URL . 'home" target="_BLANK">home</a>)</small>';
        }else{
            return '<small style="float: right;">(<a href="' . URL . $checkLink . '" target="_BLANK">' . $checkLink . '</a>)</small>';
        }
    }
}
