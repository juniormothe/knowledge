<?php

namespace Classe;

use PDO;
use Exception;

/**
 * @copyright (c) 2022, Junior Silva
 */
class Read extends Conn
{
    private $conn;
    private $table;
    private $query;
    private $terms;
    private $result;

    public function __construct()
    {
        $this->conn = $this->getConn();
    }

    public function record(string $table, string $terms)
    {
        $this->table = (string) $table;
        $this->terms = (string) $terms;
        $this->treatQuery();
        $this->treatExecute();
    }

    public function recordAll(string $query)
    {
        $this->query = (string) $query;
        $this->treatQuery();
        $this->treatExecute();
    }

    public function getResult()
    {
        $this->treatResult();
        return $this->result;
    }

    private function treatQuery()
    {
        if (!empty($this->table)) {
            $this->query = "SELECT * FROM " . $this->table . " " . $this->terms." LIMIT 1";
        }
    }

    private function treatExecute()
    {
        $this->query = $this->conn->prepare($this->query);
        $this->query->setFetchMode(PDO::FETCH_ASSOC);
        $this->query->execute();
        $this->result = $this->query->fetchAll();
    }

    private function treatResult()
    {
        if(!empty($this->result)){
            if (!empty($this->table)) {
                $this->result = $this->result[0];
            }
        }else{
            $this->result = array();
        }
    }
    
}
