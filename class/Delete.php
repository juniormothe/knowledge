<?php

namespace Classe;

use PDO;
use Exception;

/**
 * @copyright (c) 2022, Junior Silva
 */
class Delete extends Conn
{
    private $conn;
    private $table;
    private $terms;
    private $query;
    private $result;

    public function __construct()
    {
        $this->conn = $this->getConn();
    }

    public function delete(string $table, string $terms)
    {
        $this->table = (string) $table;
        $this->terms = (string) $terms;
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
        $this->query = "DELETE FROM " . $this->table . " " . $this->terms;
    }

    private function treatPrepare()
    {
        $this->query = $this->conn->prepare($this->query);
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
