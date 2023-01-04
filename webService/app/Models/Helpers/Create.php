<?php

namespace App\Models\Helpers;

use PDO;
use Exception;

/**
 * @copyright (c) 2022, Junior Silva
 */
class Create extends Conn
{
    private $Tabela;
    private $Dados;
    private $Resultado;
    private $Query;
    private $Conn;

    public function exeCreate($Tabela, array $Dados)
    {
        $this->Tabela = (string) $Tabela;
        $this->Dados  = $Dados;
        $this->getIntrucao();
        $this->executarInstrucao();
    }

    public function fullCreate($Tabela, array $Dados)
    {
        $this->exeCreate($Tabela, $Dados);
        if ($this->getResultado()) {
            $Update = new \App\Models\Helpers\Update();
            $Cryptography = new \App\Models\Helpers\Cryptography();
            
            $arrayView = ['view' => $Cryptography->createViewer($Tabela, $this->getResultado())];
            $Update->exeUpdate($Tabela, $arrayView, "WHERE (id='" . $this->getResultado() . "')");
        }
    }

    public function displayView($table, $id)
    {
        $Cryptography = new \App\Models\Helpers\Cryptography();
        return $Cryptography->displayView($table, $id);
    }

    public function saveLog(string $description)
    {
        $Log = new \App\Models\Helpers\Log();
        $Log->save($description);
    }

    private function getIntrucao()
    {
        $colunas = implode(', ', array_keys($this->Dados));
        $valores = ":" . implode(', :', array_keys($this->Dados));
        $this->Query = "INSERT INTO {$this->Tabela} ({$colunas}) VALUES ({$valores})";
    }

    private function executarInstrucao()
    {
        $this->conexao();
        try {
            $this->Query->execute($this->Dados);
            $this->Resultado = $this->Conn->lastInsertId();
        } catch (Exception $ex) {
            $this->Resultado = NULL;
        }
    }

    private function conexao()
    {
        $this->Conn  = parent::getConn();
        $this->Query = $this->Conn->prepare($this->Query);
    }

    function getResultado()
    {
        return $this->Resultado;
    }
}
