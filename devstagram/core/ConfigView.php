<?php

namespace Core;

class ConfigView
{
    private $nome;
    private $dados;

    public function __construct($nome, array $dados = NULL)
    {
        $this->nome     = $nome;
        $this->dados    = $dados;
    }

    public function renderizar()
    {
        if (file_exists('app/' . $this->nome . '.php')) {
            include 'app/' . $this->nome . '.php';
        } else {
            echo "Erro ao carregar view";
        }
    }
}
