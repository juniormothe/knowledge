<?php

namespace Classe;

use PDO;
use Exception;

/**
 * Classe Criar
 * 
 * Está classe é responsável por inserir novos registro no banco de dados MySQL
 * 
 * @param private $conn Conexão com o banco de dados
 * @param private $table Nome tabela que receberar os dados
 * @param private $data Array de dados para ser inserido, chave do array deve ter o mesmo nome da coluna
 * @param private $query Sql responsável por executar o comando
 * @param private $result Resultado da inserção de dados
 * 
 * @method public creat() Recebe o nome da tabela e array de dados. Insere no banco de dados utilizando a biblioteca PDO 
 * @method public getResult() Retorna o parâmetro $result
 * @method private treatQuery() Auxiliar que trata a query deixando padronizado
 * @method private treatPrepare() Auxiliar que prepara a query e os dados
 * @method private treatExecute() Auxiliar que executa a query
 * 
 * @package Meus códigos
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
