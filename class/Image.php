<?php

namespace Classe;

use DirectoryIterator;

/**
 * Classe de Imagem
 * 
 * Está classe é responsável por salvar e redimencionar imagem
 * 
 * @param private $image Imagem enviada por FILE
 * @param private $directory Diretorio onde será salva as imagens
 * @param private $size Tamanho do redimencionamento 00x00
 * 
 * @method public save() ... 
 * @method public listImgDirectory() ... 
 * @method public trash() ... 
 * @method private directory() ... 
 * @method private divideDirectory() ... 
 * @method private checkDirectory() ... 
 * @method private checkSize() ... 
 * @method private resize() ... 
 * 
 * @package Meus códigos
 * @copyright (c) 2022, Junior Silva <junior.mothe@gmail.com>
 */
class Image       
{
    private $image; 
    private $directory; 
    private $size; 

    public function save(array $image, $directory, $size = null)
    {
        $this->image = $image;
        $this->directory = $directory;
        $this->directory();
        if (!empty($this->image)) {
            for ($save = 0; $save < count($this->image['name']); $save++) {
                if ($this->checkExtension($this->image['type'][$save])) {
                    $this->size = $size;
                    $this->checkSize();
                    $tmpname = md5(time() . rand(0, 999) . $save) . ".jpeg";
                    move_uploaded_file($this->image['tmp_name'][$save], $this->directory . $tmpname);
                    $this->resize($this->directory . $tmpname, $this->image['type'][$save]);
                }
            }
        }
    }

    public function listImgDirectory($directory)
    {
        $listarImgDirectory = array();
        foreach (new DirectoryIterator($directory) as $fileInfo) {
            if ($fileInfo->isDot()) continue;
            $listarImgDirectory[] = $directory . $fileInfo->getFilename();
        }
        return $listarImgDirectory;
    }

    public function trash($location)
    {
        unlink($location);
    }

    private function checkExtension($extension)
    {
        if (in_array($extension, array('image/jpg', 'image/jpeg', 'image/png', 'image/gif'))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function directory()
    {
        if (!empty($this->directory)) {
            $this->divideDirectory();
            $this->checkDirectory();
            $directory = (array) $this->directory;
            $this->directory = implode('/', $directory) . "/";
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
    
    private function checkSize()
    {
        if (!empty($this->size)) {
            $size = explode('x', str_replace("X", "x", $this->size));
            $size['width'] = $size[0];
            if (empty($size[1])) {
                $size['height'] = $size[0];
                unset($size[0]);
            } else {
                $size['height'] = $size[1];
                unset($size[0], $size[1]);
            }
            $this->size = $size;
        } else {
            $this->size = array();
        }
    }
    
    private function resize($location, $type)
    {
        if (!empty($this->size)) {
            list($width, $height) = getimagesize($location);
            if (($this->size['width'] / $this->size['height']) > ($width / $height)) {
                $this->size['width'] = ($this->size['height'] * ($width / $height));
            } else {
                $this->size['height'] = ($this->size['width'] / ($width / $height));
            }
            $img = imagecreatetruecolor($this->size['width'], $this->size['height']);
            switch ($type) {
                case 'image/jpg':
                case 'image/jpeg':
                    $imgOrig = imagecreatefromjpeg($location);
                    imagecopyresampled($img, $imgOrig, 0, 0, 0, 0, $this->size['width'], $this->size['height'], $width, $height);
                    imagejpeg($img, $location, 100);
                    break;
                case 'image/png':
                    $imgOrig = imagecreatefrompng($location);
                    imagealphablending($img, false);
                    imagesavealpha($img, true);
                    imagecopyresampled($img, $imgOrig, 0, 0, 0, 0, $this->size['width'], $this->size['height'], $width, $height);
                    imagepng($img, $location);
                    break;
                case 'image/gif':
                    $imgOrig = imagecreatefromgif($location);
                    imagecopyresampled($img, $imgOrig, 0, 0, 0, 0, $this->size['width'], $this->size['height'], $width, $height);
                    imagegif($img, $location);
                    break;
                default:
                    $imgOrig = imagecreatefromjpeg($location);
                    imagecopyresampled($img, $imgOrig, 0, 0, 0, 0, $this->size['width'], $this->size['height'], $width, $height);
                    imagejpeg($img, $location, 100);
                    break;
            }
        }
    }
}
