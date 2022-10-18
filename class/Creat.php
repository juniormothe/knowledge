<?php

namespace Classe;

use PDO;
use Exception;

/**
 * Classe de conexão
 * 
 * Está classe é responsável por inserir novos registro no banco de dados MySQL
 * 
 * @param . $conn Conexão com o banco de dados
 * @param . $table Nome tabela que receberar os dados
 * @param . $data Array de dados para ser inserido, chave do array deve ter o mesmo nome da coluna
 * @param . $query Sql responsável por executar o comando
 * @param . $result Resultado da inserção de dados
 * 
 * @method . creat() Recebe o nome da tabela e array de dados. Insere um novo registro no banco de dados utilizando a biblioteca PDO 
 * @method . getResult() Retorna o parâmetro $result
 * @method . treatQuery() Auxiliar que trata a query deixando padronizado
 * @method . treatPrepare() Auxiliar que prepara a query e os dados
 * @method . treatExecute() Auxiliar que executa a query
 * 
 * @package Aula
 * @copyright (c) 2022, Junior Silva <junior.mothe@gmail.com>
 */
class Creat extends Conn
{
    private $conn;
    private $table;
    private $data;
    private $query;
    private $result;

    public function __construct()
    {
        $this->conn = $this->getConn();
    }

    public function creat(string $table, array $data)
    {
        $this->table = (string) $table;
        $this->data  = (array) $data;
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
        $columns = implode(', ', array_keys($this->data));
        $values = ":" . implode(', :', array_keys($this->data));
        $this->query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
    }

    private function treatPrepare()
    {
        $this->query = $this->conn->prepare($this->query);
        foreach ($this->data as $keyData => $valueData) {
            $this->query->bindValue(":".$keyData, $valueData);
        }
    }

    private function treatExecute()
    {
        try {
            $this->query->execute();
            $this->result = $this->conn->lastInsertId();
        } catch (Exception $ex) {
            $this->result = FALSE;
        }
    }
    
}
