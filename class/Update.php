<?php

namespace Classe;

use PDO;
use Exception;

/**
 * @copyright (c) 2022, Junior Silva
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
