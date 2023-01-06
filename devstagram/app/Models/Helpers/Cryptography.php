<?php

namespace App\Models\Helpers;

/**
 * @copyright (c) 2022, Junior Silva
 */
class Cryptography
{

    public function encryptPassword($password)
    {
        $password = trim($password);
        $password = password_hash($password, PASSWORD_DEFAULT);
        return $password;
    }

    public function firstPassword($nomeSlug)
    {
        $firstPassword = explode('-', $nomeSlug);
        $firstPassword = $firstPassword[0];
        $firstPassword = $this->encryptPassword($firstPassword);
        return $firstPassword;
    }

    public function checkPassword($passwordForm, $passwordDb)
    {
        if (password_verify($passwordForm, $passwordDb)) {
            return true;
        } else {
            return false;
        }
    }

    public function createViewer($table, $id)
    {
        $Viewer = base64_encode($id);
        $Viewer = base64_encode($Viewer);

        $Viewer = $this->treatViewer($this->randomLetter(rand(0, 9)) . $Viewer);
        $Viewer = $this->checkViewer($table, $Viewer);
        return $Viewer;
    }

    public function displayView($table, $id)
    {
        $Read = new \App\Models\Helpers\Read();
        $Read->fullRead("SELECT view FROM " . $table . " WHERE (id='" . $id . "') LIMIT 1");
        $displayView = $Read->getResultado();
        if (!empty($displayView)) {
            return $displayView[0]['view'];
        } else {
            return '';
        }
    }

    public function displayId($table, $view)
    {
        $Read = new \App\Models\Helpers\Read();
        $Read->fullRead("SELECT id FROM " . $table . " WHERE (view='" . $view . "') LIMIT 1");
        $displayView = $Read->getResultado();
        if (!empty($displayView)) {
            return $displayView[0]['id'];
        } else {
            return 0;
        }
    }

    private function treatViewer($Viewer)
    {
        $Slug = new \App\Models\Helpers\Slug();
        $treatViewer = $Slug->nomeSlug($Viewer);
        $treatViewer = str_replace('-', $this->randomLetter(rand(0, 9)), $treatViewer);
        $treatViewer = preg_replace('/[0-9]/', '', $treatViewer);
        return $treatViewer;
    }

    private function checkViewer($table, $Viewer)
    {
        $Read = new \App\Models\Helpers\Read();
        $Read->exeRead($table, "WHERE (viewer='" . $Viewer . "')");
        if ($Read->getResultado()) {
            $this->checkViewer($table, $Viewer . $this->randomLetter(rand(0, 99)));
        } else {
            return $Viewer;
        }
    }

    private function randomLetter($key)
    {
        $randomLetter = ['a', 'e', 'i', 'o', 'u', 'y', 'w', 'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'x', 'y', 'z', 'w', 'k', 'w', 'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'j', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'x', 'y', 'z', 'w', 'k', 'w', 'w', 'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n'];
        return $randomLetter[$key];
    }
}
