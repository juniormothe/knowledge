<?php

namespace Classe;

/**
 * @copyright (c) 2022, Junior Silva
 */
class Directory
{
    private $directory;

    public function __construct($directory)
    {
        $this->directory = $directory;
        if (!empty($this->directory)) {
            $this->divideDirectory();
            $this->checkDirectory();
        }
    }

    private function divideDirectory()
    {
        if (strpos($this->directory, "\\") !== false) {
            $divideDirectory = explode('\\', $this->directory);
        } else {
            $divideDirectory = explode('/', $this->directory);
        }
        if (empty($divideDirectory[count($divideDirectory) - 1])) {
            unset($divideDirectory[count($divideDirectory) - 1]);
        }
        if (empty($divideDirectory[0])) {
            unset($divideDirectory[0]);
        }
        $this->directory = array_values($divideDirectory);
    }

    private function checkDirectory()
    {
        $checkDirectory = (array) $this->directory;
        foreach ($checkDirectory as $keyDirectory => $valueDirectory) {
            $directory = '';
            for ($i = 0; $i <= $keyDirectory; $i++) {
                $directory .= $checkDirectory[$i] . "/";
            }
            $directory = rtrim($directory, '/');
            if (!is_dir($directory)) {
                mkdir($directory, 0777);
            }
        }
    }
}
