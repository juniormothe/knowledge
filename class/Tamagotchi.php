<?php

namespace Classe;

/**
 * @copyright (c) 2022, Junior Silva <junior.mothe@gmail.com>
 * 
 * 30 min (1800) dormi
 * 10 min (600) carinho
 * 15 min (900) fome
 */
class Tamagotchi
{
    //Adicionar ações

    public function addFood()
    {
        $fileHungry = fopen('views/tamagotchi/dataBase/hungry.txt', 'a+');
        $line = time() . ";" . ($_SESSION['hungry']['value'] + 1) . "\n";
        fwrite($fileHungry, $line);
        fclose($fileHungry);
        $_SESSION['food'] = 2;
        header('location: ' . URL);
    }

    public function addCare()
    {
        $fileSad = fopen('views/tamagotchi/dataBase/sad.txt', 'a+');
        $line = time() . ";" . ($_SESSION['sad']['value'] + 1) . "\n";
        fwrite($fileSad, $line);
        fclose($fileSad);
        $_SESSION['care'] = 2;
        header('location: ' . URL);
    }

    public function addSleeping()
    {
        if ($_SESSION['sleeping']['status'] == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        $fileSleeping = fopen('views/tamagotchi/dataBase/sleeping.txt', 'a+');
        $line = time() . ";" . $status . "\n";
        fwrite($fileSleeping, $line);
        fclose($fileSleeping);
        header('location: ' . URL);
    }

    //Verificar elementos
    private $hungry;
    private $sleeping;
    private $sad;

    public function __construct()
    {
        if (!isset($_SESSION['food'])) {
            $_SESSION['food'] = 0;
        }
        if (!isset($_SESSION['care'])) {
            $_SESSION['care'] = 0;
        }
        $_SESSION['foodButton'] = "";
        $_SESSION['careButton'] = "";
        $_SESSION['sleepingButton'] = "";
        $this->ceckHungry();
        $this->ceckSad();
        $this->ceckSleeping();
        $this->checkAction();
        $this->checkGif();
    }

    private function checkAction()
    {
        $sleeping = (time() - $this->sleeping['time']);
        $hungry = (time() - $this->hungry['time']);
        $sad = (time() - $this->sad['time']);
        $sadIndex = 0;
        if ($sad > 600) {
            $sadIndex = floor(($sad / 600));
            if ($sadIndex > 10) {
                $sadIndex = 10;
            }
        }
        $hungryIndex = 0;
        if ($hungry > 900) {
            $hungryIndex = floor(($hungry / 900));
            if ($hungryIndex > 4) {
                $hungryIndex = 4;
            }
        }
        $this->updateSleeping($sleeping);
        $this->updateHungry($hungryIndex);
        $this->updateSad($sadIndex);
    }

    private function updateHungry($index)
    {
        if (($index > 0) && ($this->hungry['value'] > 0)) {
            $fileHungry = fopen('views/tamagotchi/dataBase/hungry.txt', 'a+');
            $line = time() . ";" . (intval($this->hungry['value']) - $index) . "\n";
            fwrite($fileHungry, $line);
            fclose($fileHungry);
        }
    }

    private function updateSad($index)
    {
        if (($index > 0) && ($this->sad['value'] > 0)) {
            $fileSad = fopen('views/tamagotchi/dataBase/sad.txt', 'a+');
            $line = time() . ";" . (intval($this->sad['value']) - $index) . "\n";
            fwrite($fileSad, $line);
            fclose($fileSad);
        }
    }

    private function updateSleeping($time)
    {
        if (($this->sleeping['status'] == 1) && ($time > 1800)) {
            $fileSleeping = fopen('views/tamagotchi/dataBase/sleeping.txt', 'a+');
            $line = time() . ";1\n";
            fwrite($fileSleeping, $line);
            fclose($fileSleeping);
        }
    }

    private function checkGif()
    {
        if ($this->sleeping['status'] == 1) {
            $_SESSION['foodButton'] = "disabled";
            $_SESSION['careButton'] = "disabled";
            $_SESSION['sleepingButton'] = "";
            $_SESSION['sleepingButtonName'] = "Acordar";
            $_SESSION['gif'] = "sleep";
        } else {
            $_SESSION['sleepingButtonName'] = "Dormir";
            if ($_SESSION['food'] > 0) {
                $_SESSION['gif'] = "yum";
                $_SESSION['foodButton'] = "disabled";
            } else {
                if ($this->hungry['value'] < 2) {
                    $_SESSION['gif'] = "big-frown";
                } elseif ($this->hungry['value'] >= 4) {
                    $_SESSION['gif'] = "smile";
                    $_SESSION['foodButton'] = "disabled";
                } else {
                    $_SESSION['gif'] = "smile";
                }
            }
            if ($_SESSION['care'] > 0) {
                $_SESSION['gif'] = "heart-face";
                $_SESSION['careButton'] = "disabled";
            } else {
                if ($this->sad['value'] <= 2) {
                    $_SESSION['gif'] = "rage";
                } elseif ($this->sad['value'] <= 4) {
                    $_SESSION['gif'] = "triumph";
                } elseif ($this->sad['value'] >= 10) {
                    $_SESSION['gif'] = "smile";
                    $_SESSION['careButton'] = "disabled";
                }
            }
        }
    }

    //Verificações de dados
    //Utilizando txt como base de dados
    private function ceckHungry()
    {
        $fileHungry = fopen('views/tamagotchi/dataBase/hungry.txt', 'a+');
        if (filesize('views/tamagotchi/dataBase/hungry.txt') <= 0) {
            $line = time() . ";2\n";
            fwrite($fileHungry, $line);
        }
        fclose($fileHungry);
        $this->arrayHungry();
    }

    private function arrayHungry()
    {
        $fileHungry = fopen('views/tamagotchi/dataBase/hungry.txt', 'a+');
        $array = array();
        while (!feof($fileHungry)) {
            $line = fgets($fileHungry, 1024);
            $line = explode(";", $line);
            if (!empty($line[0])) {
                $array['time'] = $line[0];
                $array['value'] = $line[1];
            }
        }
        fclose($fileHungry);
        $this->hungry = $array;
        $_SESSION['hungry'] = $this->hungry;
    }

    private function ceckSad()
    {
        $fileSad = fopen('views/tamagotchi/dataBase/sad.txt', 'a+');
        if (filesize('views/tamagotchi/dataBase/sad.txt') <= 0) {
            $line = time() . ";6\n";
            fwrite($fileSad, $line);
        }
        fclose($fileSad);
        $this->arraySad();
    }

    private function arraySad()
    {
        $fileSad = fopen('views/tamagotchi/dataBase/sad.txt', 'a+');
        $array = array();
        while (!feof($fileSad)) {
            $line = fgets($fileSad, 1024);
            $line = explode(";", $line);
            if (!empty($line[0])) {
                $array['time'] = $line[0];
                $array['value'] = $line[1];
            }
        }
        fclose($fileSad);
        $this->sad = $array;
        $_SESSION['sad'] = $this->sad;
    }

    private function ceckSleeping()
    {
        $fileSleeping = fopen('views/tamagotchi/dataBase/sleeping.txt', 'a+');
        if (filesize('views/tamagotchi/dataBase/sleeping.txt') <= 0) {
            $line = time() . ";0\n";
            fwrite($fileSleeping, $line);
        }
        fclose($fileSleeping);
        $this->arraySleeping();
    }

    private function arraySleeping()
    {
        $fileSleeping = fopen('views/tamagotchi/dataBase/sleeping.txt', 'a+');
        $array = array();
        while (!feof($fileSleeping)) {
            $line = fgets($fileSleeping, 1024);
            $line = explode(";", $line);
            if (!empty($line[0])) {
                $array['time'] = $line[0];
                $array['status'] = $line[1];
            }
        }
        fclose($fileSleeping);
        $this->sleeping = $array;
        $_SESSION['sleeping'] = $this->sleeping;
    }
}
