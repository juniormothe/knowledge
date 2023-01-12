<?php

namespace App\Models\Helpers;

/**
 * @copyright (c) 2022, Junior Silva
 */
class SaveImg
{
    private $img; //Array da imagem que será salva
    private $directory; //Diretório onde será salva a imagem, diretório raiz tem que quer criado antes 
    private $table; //Tabela do banco de dados, onde será salva o caminho da imagem
    private $column; //Coluna da tabela do banco de dados, onde será salva o caminho da imagem
    private $id; //Identificador do registro, onde será salva a imagem
    private $typeId; //Tipo de identificador 1 = id e 2 = viewer
    private $dbImg; //String com o local da imagem, desconsiderando a pasta raiz das imagens
    private $filename; //String com o local da imagem, considerando a pasta raiz das imagens
    private $result; //Resultado

    function __construct($img, $directory, $table, $column, $id)
    {
        $this->img = $img;
        $this->directory = $directory;
        $this->table = $table;
        $this->column = $column;
        $this->id = $id;
        $this->dbImg = NULL;
        $this->filename = NULL;

        if (isset($this->img['imagem'])) {
            if ($this->img['imagem']['size'] > 0) {
                $UploadImg = new \App\Models\Helpers\UploadImg();
                $Slug = new \App\Models\Helpers\Slug();
                $nameImg = $Slug->nomeSlug($this->img['imagem']['name']);
                $locationImg = $this->directory . "/" . $this->id . "/";
                $UploadImg->uploadImagem($this->img['imagem'], $locationImg, $nameImg);

                $this->dbImg = $locationImg . $nameImg;
                $this->filename = $locationImg . $nameImg;

                if (file_exists($this->filename)) {
                    if ($this->saveImgDb()) {
                        $this->result = true;
                    } else {
                        $this->result = false;
                    }
                } else {
                    $this->result = false;
                }
            } else {
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }

    private function saveImgDb()
    {
        $arrayImg = [$this->column => $this->dbImg];
        $Update = new \App\Models\Helpers\Update();
        $Update->exeUpdate($this->table, $arrayImg, "WHERE (id='" . $this->id . "')");
        if ($Update->getResultado()) {
            $this->result = true;
        } else {
            $this->result = false;
        }
    }

    function getResult()
    {
        return $this->result;
    }
}
