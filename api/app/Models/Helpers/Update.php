<?php

namespace App\Models\Helpers;

use PDO;
use Exception;

/**
 * @copyright (c) 2022, Junior Silva
 */
class Update extends Conn
{
    private $Tabela;
    private $Dados;
    private $Query;
    private $Conn;
    private $Resultado;
    private $Termos;
    private $Values;

    function getResultado()
    {
        return $this->Resultado;
    }

    function getQuery()
    {
        return $this->Query;
    }

    public function exeUpdate($Tabela, array $Dados, $Termos = null, $ParseString = null)
    {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        $this->Termos = (string) $Termos;

        parse_str($ParseString, $this->Values);
        $this->getIntrucao();
        $this->executarInstrucao();
    }

    public function delete($Tabela, $id)
    {
        $arrayDelete = ['status' => 0, 'id_update' => $_SESSION['logged']['id'], 'date_update' => date('Y-m-d')];
        $this->exeUpdate($Tabela, $arrayDelete, "WHERE (id='" . $id . "')");
    }

    public function saveLog(string $description)
    {
        $Log = new \App\Models\Helpers\Log();
        $Log->save($description);
    }

    private function getIntrucao()
    {
        foreach ($this->Dados as $key => $Value) {
            $Values[] = $key . '= :' . $key;
        }
        $Values = implode(', ', $Values);
        $this->Query = "UPDATE {$this->Tabela} SET {$Values} {$this->Termos}";
    }

    private function executarInstrucao()
    {
        $this->conexao();
        try {
            $this->Query->execute(array_merge($this->Dados, $this->Values));
            $this->Resultado = true;
        } catch (Exception $ex) {
            $this->Resultado = null;
        }
    }

    private function conexao()
    {
        $this->Conn = parent::getConn();
        $this->Query = $this->Conn->prepare($this->Query);
    }
}
