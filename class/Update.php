<?php

namespace Classe;

use PDO;
use Exception;

/**
 * Classe de edição
 * 
 * Está classe é responsável por editar informações no banco de dados MYSQL
 * 
 * @param private $conn ...
 * @param private $data ...
 * @param private $table ...
 * @param private $terms ...
 * @param private $query ...
 * @param private $result ...
 * 
 * @method public update() ... 
 * @method public getResult() ... 
 * @method private treatQuery() ... 
 * @method private treatSet() ... 
 * @method private treatPrepare() ... 
 * @method private treatExecute() ... 
 * 
 * @package Meus códigos
 * @copyright (c) 2022, Junior Silva <junior.mothe@gmail.com>
 */
class Update extends Conn
{
    private $conn;
    private $data;
    private $table;
    private $terms;
    private $query;
    private $result;

    public function __construct()
    {
        $this->conn = $this->getConn();
    }

    public function update(string $table, string $terms, array $data)
    {
        $this->table = (string) $table;
        $this->terms = (string) $terms;
        $this->data = (array) $data;
        $this->treatQuery();
        $this->treatPrepare();
        $this->treatExecute();
    }

    public function getResult()
    {
        return $this->result;
    }

    private function treatQuery()
    {
        $this->query = "UPDATE " . $this->table . " SET " . $this->treatSet() . " " . $this->terms;
    }

    private function treatSet()
    {
        foreach ($this->data as $keyData => $valueData) {
            $treatSet[] = $keyData . " = :" . $keyData;
        }
        return implode(', ', $treatSet);
    }

    private function treatPrepare()
    {
        $this->query = $this->conn->prepare($this->query);
        foreach ($this->data as $keyData => $valueData) {
            $this->query->bindValue(":" . $keyData, $valueData);
        }
    }

    private function treatExecute()
    {
        try {
            $this->query->execute();
            $this->result = TRUE;
        } catch (Exception $ex) {
            $this->result = FALSE;
        }
    }
}
