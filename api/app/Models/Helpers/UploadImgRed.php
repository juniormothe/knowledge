<?php

namespace App\Models\Helpers;

/**
 * @copyright (c) year, Junior Silva
 */
class UploadImgRed 
{
    private $DadosImagem;
    private $Diretorio;
    private $NomeImg;
    private $Resultado;
    private $Imagem;
    private $Largura;
    private $Altura;
    private $ImgRedimens;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function uploadImagem(array $Imagem, $Diretorio, $NomeImg, $Largura, $Altura)
    {
        $this->DadosImagem  = $Imagem;
        $this->Diretorio = $Diretorio;
        $this->NomeImg = $NomeImg;
        $this->Largura = $Largura;
        $this->Altura = $Altura;
        $this->validarImagem();

        if ($this->Imagem) {
            $this->Resultado = true;
        } else {
            $this->Resultado = false;
        }
    }

    private function validarImagem()
    {
        switch ($this->DadosImagem['type']):
            case 'image/jpeg';
            case 'image/pjpeg';
                $this->Imagem = imagecreatefromjpeg($this->DadosImagem['tmp_name']);
                $this->redimensImg();
                $this->valDiretorio();
                imagejpeg($this->ImgRedimens, $this->Diretorio. $this->NomeImg);
                break;
            case 'image/png':
            case 'image/x-png';
                $this->Imagem = imagecreatefrompng($this->DadosImagem['tmp_name']);
                $this->redimensImg();
                $this->valDiretorio();
                imagepng($this->ImgRedimens, $this->Diretorio . $this->NomeImg);
                break;
        endswitch;
    }

    private function valDiretorio()
    {
        if (!file_exists($this->Diretorio) && !is_dir($this->Diretorio)) {
            mkdir($this->Diretorio, 0755);
        }
    }

    private function redimensImg()
    {
        $largura_original = imagesx($this->Imagem);
        $altura_original  = imagesy($this->Imagem);

        $this->ImgRedimens = imagecreatetruecolor($this->Largura, $this->Altura);

        imagecopyresampled($this->ImgRedimens, $this->Imagem, 0, 0, 0, 0, $this->Largura, $this->Altura, $largura_original, $altura_original);
    }
}
